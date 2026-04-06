<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $defaultSchool = School::firstOrCreate(
            ['code' => 'default'],
            ['name' => 'École Principale', 'is_active' => true]
        );

         // Créer un utilisateur administrateur
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('loveokok'),
            'role' => 'admin',
        ]);
        $admin->schools()->syncWithoutDetaching([$defaultSchool->id]);

        // Créer un utilisateur secrétaire
        $secretary = User::create([
            'name' => 'Secretaire',
            'email' => 'secre@secre.com',
            'password' => Hash::make('123456789'),
            'role' => 'secretary',
        ]);
        $secretary->schools()->syncWithoutDetaching([$defaultSchool->id]);
    }
}
