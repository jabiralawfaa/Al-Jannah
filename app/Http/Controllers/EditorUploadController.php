<?php

namespace App\Http\Controllers;

use App\Models\FileOrganisasi;
use App\Services\FileRenamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:20480',
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $extension = strtolower($uploadedFile->getClientOriginalExtension());
        $mimeType = $uploadedFile->getMimeType();

        $kategori = $this->klasifikasikanEkstensi($extension);

        $disk = match ($kategori) {
            'diterima' => 'file_diterima',
            'mencurigakan' => 'file_mencurigakan',
            'ditolak' => 'file_ditolak',
            default => 'file_diterima',
        };

        $storedPath = FileRenamer::rename($originalName);
        $uploadedFile->storeAs('', $storedPath, $disk);

        $fileRecord = FileOrganisasi::create([
            'nama_file' => $originalName,
            'file_path' => $storedPath,
            'kategori' => $kategori,
            'status' => 'aktif',
            'uploaded_by' => auth()->id(),
        ]);

        $url = Storage::disk($disk)->url($storedPath);

        return response()->json([
            'success' => true,
            'file' => [
                'id' => $fileRecord->id,
                'nama_file' => $originalName,
                'file_path' => $storedPath,
                'url' => $url,
                'mime_type' => $mimeType,
                'extension' => $extension,
                'kategori' => $kategori,
            ],
        ]);
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
}
