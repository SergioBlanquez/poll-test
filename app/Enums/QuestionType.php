<?php

namespace App\Enums;

enum QuestionType: int
{
    case BOOLEAN = 1;
    case TEXT = 2;
    case PERCENTAGE = 3;

    public function label(): string
    {
        return match($this) {
            self::BOOLEAN => 'Sí/No',
            self::TEXT => 'Texto',
            self::PERCENTAGE => 'Porcentaje',
        };
    }

    public function description(): string
    {
        return match($this) {
            self::BOOLEAN => 'Pregunta de respuesta Sí o No',
            self::TEXT => 'Pregunta de respuesta en texto libre',
            self::PERCENTAGE => 'Pregunta de respuesta en porcentaje (0-100)',
        };
    }
} 