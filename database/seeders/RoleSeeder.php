<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'nama_role' => 'Super Admin',
                'keterangan' => 'Akses penuh sistem'
            ],
            [
                'nama_role' => 'Admin',
                'keterangan' => 'Kelola data inventori'
            ],
            [
                'nama_role' => 'Manajer Toko',
                'keterangan' => 'Monitoring & laporan'
            ]
        ]);
    }
}

