<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Créer un utilisateur administrateur
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('loveokok'),
            'role' => 'admin',
        ]);

        // Créer un utilisateur secrétaire
        User::create([
            'name' => 'Secretaire',
            'email' => 'secre@secre.com',
            'password' => Hash::make('123456789'),
            'role' => 'secretary',
        ]);
    }
}
