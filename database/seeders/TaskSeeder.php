<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Employee;
use Faker\Factory as Faker;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        // Obtener los IDs de los estados de tarea y empleados existentes
        $statusIds = TaskStatus::pluck('id')->toArray();
        $employeeIds = Employee::pluck('id')->toArray();

        // Crear dos tareas de ejemplo
        for ($i = 0; $i < 2; $i++) {
            Task::create([
                'status_id' => $faker->randomElement($statusIds),
                'employee_id' => $faker->randomElement($employeeIds),
                'title' => $faker->sentence(5),
                'description' => $faker->paragraph(3),
                'created_by' => 'Seeder',
            ]);
        }
    }
}
