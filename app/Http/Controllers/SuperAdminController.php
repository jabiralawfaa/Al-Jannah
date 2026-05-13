<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FileOrganisasi;
use App\Models\LogSuperadmin;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $files = FileOrganisasi::all();
        $logs = LogSuperadmin::all();

        return view('dashboard.superadmin.index', compact('users', 'files', 'logs'));
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
}
