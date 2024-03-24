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
         User::create([
            'name' => 'admin',
            'email' => 'admin@taskmanager.com',
            'password' => Hash::make('admin'), // Recuerda cambiar 'password' por la contraseña deseada
        ]);

       
          User::create([
            'name'=>'editor',
            'email'=>'editor@speaksmarter.net',
            'password' => Hash::make('editor')]
        );
    }
}
