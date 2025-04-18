<?php

namespace App\Enums;

enum UserColor: string
{
    case CREATOR = 'success'; // Verde para administradores (poll_creator = true)
    case USER = 'primary';  // Azul para usuarios normales (poll_creator = false)

    public static function fromPollCreator(bool $isPollCreator): self
    {
        return $isPollCreator ? self::CREATOR : self::USER;
    }
} 