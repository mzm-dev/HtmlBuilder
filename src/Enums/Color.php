<?php

namespace Mzm\HtmlBuilder\Enums;

enum Color: string
{
    case NONE = '';
    case BLUE = 'blue';
    case GREEN = 'green';
    case RED = 'red';
    case YELLOW = 'yellow';
    case INDIGO = 'indigo';
    case PURPLE = 'purple';
    case PINK = 'pink';
    case GRAY = 'gray';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Blank',
            default => ucfirst($this->value),
        };
    }

    public function tailwindClass(): string
    {
        return match ($this) {
            self::NONE => 'bg-gray-200',
            self::BLUE => 'bg-blue-600',
            self::GREEN => 'bg-green-600',
            self::RED => 'bg-red-600',
            self::YELLOW => 'bg-yellow-600',
            self::INDIGO => 'bg-indigo-600',
            self::PURPLE => 'bg-purple-600',
            self::PINK => 'bg-pink-600',
            self::GRAY => 'bg-gray-600',
        };
    }
}
