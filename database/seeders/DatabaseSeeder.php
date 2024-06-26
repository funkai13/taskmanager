<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CommentTaskSeeder:: class);
        $this->call(TaskStatusSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
