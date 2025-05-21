<?php

namespace Database\Seeders;

use App\Models\Loker;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'nama_role' => 'admin',
        ]);

        User::create([
            'id_role' => '1',
            'name' => 'Administrator',
            'email' => 'bkk@smkmuhkandanghaur.sch.id',
            'password' => Hash::make('Secret123'),
        ]);

        Loker::create([
            'nama_loker' => 'PT.Astra Honda Motor Jakarta',
            'posisi' => 'Oprator',
            'deskripsi' => 'lorem ipsum',
            'administrasi' => '37000',
            'grup_wa' => 'lorem ipsum',
        ]);

    }
}
