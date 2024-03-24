<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'status_id' => 1, // ID del estado de la tarea (pendiente, en proceso, etc.)
            'user_id' => 1, // ID del usuario asignado a la tarea
            'title' => 'Tarea de ejemplo 1',
            'description' => 'Esta es una tarea de ejemplo 1',
            'created_by' => 'admin',
        ]);

        Task::create([
            'status_id' => 2,
            'user_id' => 2,
            'title' => 'Tarea de ejemplo 2',
            'description' => 'Esta es una tarea de ejemplo 2',
            'created_by' => 'admin',
        ]);
    }
}
