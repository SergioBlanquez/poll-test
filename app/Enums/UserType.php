<?php

namespace App\Enums;

enum UserType: string
{
    case CREATOR = 'creator';
    case USER = 'user';

    public static function fromPollCreator(bool $isPollCreator): self
    {
        return $isPollCreator ? self::CREATOR : self::USER;
    }

    public function label(): string
    {
        return match($this) {
            self::CREATOR => 'Creador',
            self::USER => 'Usuario',
        };
    }
} 