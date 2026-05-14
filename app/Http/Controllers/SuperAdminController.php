<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FileOrganisasi;
use App\Models\LogSuperadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(20)->withQueryString();

        $totalUsers = User::count();
        $activeUsers = User::where('status', 'aktif')->count();
        $files = FileOrganisasi::all();
        $logs = LogSuperadmin::all();

        return view('dashboard.superadmin.index', compact('users', 'totalUsers', 'activeUsers', 'files', 'logs'));
    }

    public function fileIndex(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');

        $files = FileOrganisasi::with('uploadedBy')
            ->when($search, function ($query, $search) {
                return $query->where('nama_file', 'like', "%{$search}%");
            })
            ->when($kategori, function ($query, $kategori) {
                return $query->where('kategori', $kategori);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $kategoriLabels = config('file-pemilah.labels');

        return view('dashboard.superadmin.file', compact('files', 'kategoriLabels'));
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $extension = strtolower($uploadedFile->getClientOriginalExtension());

        $kategori = $this->klasifikasikanEkstensi($extension);

        $disk = match ($kategori) {
            'diterima' => 'file_diterima',
            'mencurigakan' => 'file_mencurigakan',
            'ditolak' => 'file_ditolak',
            default => 'file_ditolak',
        };

        $safeFilename = pathinfo($originalName, PATHINFO_FILENAME);
        $safeFilename = preg_replace('/[^a-zA-Z0-9\-\_]/i', '_', $safeFilename);
        $storedPath = $safeFilename . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;

        $path = $uploadedFile->storeAs('', $storedPath, $disk);

        if (!$path) {
            return redirect('/superadmin/file')->with('error', 'Gagal menyimpan file.');
        }

        $fileRecord = FileOrganisasi::create([
            'nama_file' => $originalName,
            'file_path' => $storedPath,
            'kategori' => $kategori,
            'status' => 'aktif',
            'uploaded_by' => auth()->id(),
        ]);

        LogSuperadmin::create([
            'user_id' => auth()->id(),
            'aksi' => 'upload',
            'deskripsi' => 'Mengunggah file: ' . $originalName . ' (kategori: ' . config("file-pemilah.labels.{$kategori}") . ')',
            'modul' => 'File',
            'referensi_id' => $fileRecord->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $label = config("file-pemilah.labels.{$kategori}");
        return redirect('/superadmin/file')->with('success', "File \"{$originalName}\" berhasil diunggah sebagai kategori: {$label}.");
    }

    public function downloadFile($id)
    {
        $file = FileOrganisasi::findOrFail($id);

        $disk = match ($file->kategori) {
            'diterima' => 'file_diterima',
            'mencurigakan' => 'file_mencurigakan',
            'ditolak' => 'file_ditolak',
            default => 'file_ditolak',
        };

        if (!Storage::disk($disk)->exists($file->file_path)) {
            return redirect('/superadmin/file')->with('error', 'File tidak ditemukan di penyimpanan.');
        }

        return Storage::disk($disk)->download($file->file_path, $file->nama_file);
    }

    private function klasifikasikanEkstensi(string $extension): string
    {
        $ekstensiDiterima = config('file-pemilah.diterima', []);
        $ekstensiMencurigakan = config('file-pemilah.mencurigakan', []);
        $ekstensiDitolak = config('file-pemilah.ditolak', []);

        if (in_array($extension, $ekstensiDiterima)) {
            return 'diterima';
        }

        if (in_array($extension, $ekstensiMencurigakan)) {
            return 'mencurigakan';
        }

        return 'ditolak';
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:bendahara,sekretaris,logistik,ketua,superadmin,adminweb',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        $user = User::findOrFail($id);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('/superadmin')->with('success', 'User berhasil diperbarui.');
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:bendahara,sekretaris,logistik,ketua,superadmin,adminweb',
            'status' => 'required|in:aktif,non_aktif',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        LogSuperadmin::create([
            'user_id' => auth()->id(),
            'aksi' => 'create',
            'deskripsi' => 'Menambahkan user baru: ' . $user->nama . ' (' . $user->email . ')',
            'modul' => 'User',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect('/superadmin')->with('success', 'User "' . $user->nama . '" berhasil ditambahkan.');
    }
}
