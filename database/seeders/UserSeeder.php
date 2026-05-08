<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Ketua Al-Jannah',
                'email' => 'ketua@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'ketua',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Super Admin',
                'email' => 'superadmin@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Bendahara Al-Jannah',
                'email' => 'bendahara@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'bendahara',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Sekretaris Al-Jannah',
                'email' => 'sekretaris@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'sekretaris',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Logistik Al-Jannah',
                'email' => 'logistik@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'logistik',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Admin Web',
                'email' => 'adminweb@aljannah.or.id',
                'password' => Hash::make('password'),
                'role' => 'adminweb',
                'status' => 'aktif',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
