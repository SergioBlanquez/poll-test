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

                // Obtener el array de preguntas correspondiente
                $questionsArray = match($type) {
                    QuestionType::BOOLEAN => $booleanQuestions,
                    QuestionType::TEXT => $textQuestions,
                    QuestionType::PERCENTAGE => $percentageQuestions,
                };

                // Si el array está vacío, reiniciarlo con las preguntas originales
                if (empty($questionsArray)) {
                    $questionsArray = match($type) {
                        QuestionType::BOOLEAN => [
                            '¿Está satisfecho con nuestro servicio?',
                            '¿Recomendaría nuestro producto a otros?',
                            '¿El producto cumplió con sus expectativas?',
                            '¿El servicio fue rápido y eficiente?',
                            '¿Encontró lo que estaba buscando?'
                        ],
                        QuestionType::TEXT => [
                            '¿Qué aspectos mejorarías de nuestro servicio?',
                            '¿Qué te gustó más del producto?',
                            '¿Cómo describirías tu experiencia?',
                            '¿Qué sugerencias tienes para mejorar?',
                            '¿Qué te motivó a elegirnos?'
                        ],
                        QuestionType::PERCENTAGE => [
                            '¿Qué tan satisfecho está con la atención recibida?',
                            '¿Qué tan probable es que vuelva a comprar?',
                            '¿Qué tan bien se ajusta el producto a sus necesidades?',
                            '¿Qué tan rápido fue resuelto su problema?',
                            '¿Qué tan fácil fue usar nuestro servicio?'
                        ],
                    };
                }

                // Seleccionar una pregunta aleatoria
                $randomKey = array_rand($questionsArray);
                $questionTitle = $questionsArray[$randomKey];
                unset($questionsArray[$randomKey]);

                // Actualizar el array original
                match($type) {
                    QuestionType::BOOLEAN => $booleanQuestions = $questionsArray,
                    QuestionType::TEXT => $textQuestions = $questionsArray,
                    QuestionType::PERCENTAGE => $percentageQuestions = $questionsArray,
                };

                Poll_Question::create([
                    'poll_id' => $poll->id,
                    'type' => $type->value,
                    'title' => $questionTitle,
                    'required' => fake()->boolean(70), // 70% de probabilidad de ser requerido
                    'options' => $type === QuestionType::PERCENTAGE ? json_encode(['min' => 0, 'max' => 100]) : null,
                ]);
            }

            // Generar 20 respuestas para cada pregunta de la encuesta
            $questions = Poll_Question::where('poll_id', $poll->id)->get();
            $users = User::where('poll_creator', false)->get()->random(20);

            foreach ($questions as $question) {
                foreach ($users as $user) {
                    $answer = match($question->type) {
                        QuestionType::BOOLEAN => fake()->boolean(),
                        QuestionType::TEXT => fake()->sentence(),
                        QuestionType::PERCENTAGE => fake()->numberBetween(0, 100),
                    };

                    \App\Models\Poll_Question_Answer::create([
                        'poll__question_id' => $question->id,
                        'user_id' => $user->id,
                        'answer' => $answer,
                    ]);
                }
            }
        }
    }
}
