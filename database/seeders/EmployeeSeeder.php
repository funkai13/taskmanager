<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
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
        $faker = Faker::create();

          // Obtener dos usuarios existentes
          $users = User::limit(2)->get();

          // Iterar sobre los usuarios y crear un empleado para cada uno
          foreach ($users as $user) {
              Employee::create([
                  'user_id' => $user->id,
                  'name' => $faker->sentence(1),
                  'second_name' => $faker->sentence(1),
                  'surname' => $faker->sentence(1),
                  'second_surname' => $faker->sentence(1),
                  'code' => 'EMP_' . $user->id, // Generar un código de empleado único
                  'created_by' => 'Seeder', // El usuario que creó el registro
                  'active' => true, // Por defecto, activo
              ]);
          }
    }
}
