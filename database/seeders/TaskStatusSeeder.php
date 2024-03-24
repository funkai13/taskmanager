<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create([
            'name' => 'Pendiente',
            'description' => 'Estado inicial de una tarea pendiente',
            'created_by' => 'admin', // Aquí puedes ajustar el usuario que creó este estado
            'active' => true,
        ]);

        TaskStatus::create([
            'name' => 'No activo',
            'description' => 'Estado de tarea no activo',
            'created_by' => 'admin',
            'active' => false, // Aquí establecemos el estado como no activo
        ]);

    }
}
