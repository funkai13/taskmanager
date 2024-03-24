<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\CommentTask;
use Faker\Factory as Faker;
class CommentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();

        // Crear algunos comentarios de ejemplo para tareas existentes
        $faker = Faker::create();
        foreach ($tasks as $task) {
            // Generar un número aleatorio de comentarios por tarea
            $numComments = $faker->numberBetween(0, 5);
            for ($i = 0; $i < $numComments; $i++) {
                CommentTask::create([
                    'task_id' => $task->id,
                    'comment' => $faker->sentence,
                    'created_by' => $users->random()->name, // Asignar un usuario aleatorio como autor del comentario
                ]);
            }
        }
    }
}
