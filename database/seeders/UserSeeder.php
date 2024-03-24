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
       $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@taskmanager.com',
            'password' => Hash::make('admin'), // Recuerda cambiar 'password' por la contraseña deseada
        ]);

       
        $editor = User::create([
            'name'=>'editor',
            'email'=>'editor@speaksmarter.net',
            'password' => Hash::make('editor')]
        );
    }
}
