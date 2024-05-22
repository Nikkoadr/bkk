<?php

namespace Database\Seeders;

use App\Models\Loker;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'role' => 'admin',
            'name' => 'Administrator',
            'email' => 'bkk@smkmuhkandanghaur.sch.id',
            'password' => Hash::make('P4ssw0rd'),
        ]);

        Loker::create([
            'nama_loker' => 'PT.Astra Honda Motor Jakarta',
            'deskripsi' => 'lorem ipsum',
            'jumlah_pendaftar' => '600',
        ]);
    }
}
