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
        $adminUser = User::where('email','admin@taskmanager.com')->firts();
        TaskStatus::create([
            'name' => 'Pendiente',
            'description' => 'Estado inicial de una tarea pendiente',
            'created_by' => $adminUser->id, // Aquí puedes ajustar el usuario que creó este estado
            'active' => true,
        ]);

        TaskStatus::create([
            'name' => 'No activo',
            'description' => 'Estado de tarea no activo',
            'created_by' => $adminUser->id,
            'active' => false, // Aquí establecemos el estado como no activo
        ]);

    }
}
