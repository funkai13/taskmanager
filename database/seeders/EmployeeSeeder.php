<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Obtener dos usuarios existentes
          $users = User::limit(2)->get();

          // Iterar sobre los usuarios y crear un empleado para cada uno
          foreach ($users as $user) {
              Employee::create([
                  'user_id' => $user->id,
                  'code' => 'EMP_' . $user->id, // Generar un código de empleado único
                  'name' => $user->name, // Asignar el nombre del usuario como nombre del emplead
                  'created_by' => 'Seeder', // El usuario que creó el registro
                  'active' => true, // Por defecto, activo
              ]);
          }
    }
}
