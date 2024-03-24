<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\CommentTask;
use Faker\Factory as Faker;
class CommentTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener los IDs de las tareas existentes
        $taskIds = Task::pluck('id')->toArray();

        // Crear algunos comentarios para las tareas existentes
        foreach ($taskIds as $taskId) {
            // Crear entre 1 y 3 comentarios por tarea
            $numComments = $faker->numberBetween(1, 3);
            for ($i = 0; $i < $numComments; $i++) {
                CommentTask::create([
                    'task_id' => $taskId,
                    'comment' => $faker->sentence(10),
                    'created_by' => 'Seeder',
                ]);
            }
        }
    }
}
