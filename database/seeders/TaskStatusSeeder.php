<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create([
            'name' => 'Pending',
            'description' => 'Task is pending',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'active' => true,
        ]);

        TaskStatus::create([
            'name' => 'Completed',
            'description' => 'Task is completed',
            'created_by' => 'Seeder',
            'created_at' => now(),
            'active' => true,
        ]);

    }
}
