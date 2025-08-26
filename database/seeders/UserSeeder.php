<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan proses seeding.
     */
    public function run(): void
    {
        User::create([
            'name' => 'aziz',
            'username' => 'aziz',
            'kategori' => 1,
            'id_penjamin' => 182,
            'glr_dpn' => '',
            'glr_blk' => 'S.Kom',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'avatar' => 'avatar-1.jpg',
        ]);
    }
}
