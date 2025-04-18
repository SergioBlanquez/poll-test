<?php

namespace App\Enums;

enum PollStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function fromPollStatus(bool $isPollStatus): self
    {
        return $isPollStatus ? self::ACTIVE : self::INACTIVE;
    }

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Activo',
            self::INACTIVE => 'Inactivo',
        };
    }
} 