<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);


        User::create([
            'name' => 'editor',
            'email' => 'editor@speaksmarter.net',
            'password' => bcrypt('editor'),
            'role' => 'employee'
        ]);
    }
}
