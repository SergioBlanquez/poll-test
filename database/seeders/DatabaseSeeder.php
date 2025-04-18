<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poll;
use App\Models\Poll_Question;
use App\Enums\QuestionType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear 50 usuarios normales con datos falsos
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('password'),
                'poll_creator' => false,
            ]);
        }

        // Crear usuario administrador
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'poll_creator' => true,
        ]);

        // Títulos de encuestas realistas
        $pollTitles = [
            'Satisfacción del Cliente',
            'Experiencia de Usuario',
            'Encuesta de Producto',
            'Opinión sobre Servicios',
            'Evaluación de Calidad'
        ];

        // Preguntas comunes para diferentes tipos de encuestas
        $booleanQuestions = [
            '¿Está satisfecho con nuestro servicio?',
            '¿Recomendaría nuestro producto a otros?',
            '¿El producto cumplió con sus expectativas?',
            '¿El servicio fue rápido y eficiente?',
            '¿Encontró lo que estaba buscando?'
        ];

        $textQuestions = [
            '¿Qué aspectos mejorarías de nuestro servicio?',
            '¿Qué te gustó más del producto?',
            '¿Cómo describirías tu experiencia?',
            '¿Qué sugerencias tienes para mejorar?',
            '¿Qué te motivó a elegirnos?'
        ];

        $percentageQuestions = [
            '¿Qué tan satisfecho está con la atención recibida?',
            '¿Qué tan probable es que vuelva a comprar?',
            '¿Qué tan bien se ajusta el producto a sus necesidades?',
            '¿Qué tan rápido fue resuelto su problema?',
            '¿Qué tan fácil fue usar nuestro servicio?'
        ];

        // Crear 5 encuestas con 10 preguntas cada una
        foreach ($pollTitles as $index => $title) {
            $poll = Poll::create([
                'title' => $title,
                'description' => fake()->paragraph(3),
                'status' => 1,
                'start_date' => now(),
                'end_date' => now()->addDays(fake()->numberBetween(15, 60)),
                'poll_creator_id' => $admin->id,
            ]);

            // Crear 10 preguntas para cada encuesta
            for ($j = 0; $j < 10; $j++) {
                $type = match($j % 3) {
                    0 => QuestionType::BOOLEAN,
                    1 => QuestionType::TEXT,
                    2 => QuestionType::PERCENTAGE,
                };

                $questionTitle = match($type) {
                    QuestionType::BOOLEAN => $booleanQuestions[array_rand($booleanQuestions)],
                    QuestionType::TEXT => $textQuestions[array_rand($textQuestions)],
                    QuestionType::PERCENTAGE => $percentageQuestions[array_rand($percentageQuestions)],
                };

                Poll_Question::create([
                    'poll_id' => $poll->id,
                    'type' => $type->value,
                    'title' => $questionTitle,
                    'required' => fake()->boolean(70), // 70% de probabilidad de ser requerido
                    'options' => $type === QuestionType::PERCENTAGE ? json_encode(['min' => 0, 'max' => 100]) : null,
                ]);
            }
        }
    }
}
