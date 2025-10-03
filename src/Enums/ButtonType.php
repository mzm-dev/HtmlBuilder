<?php

namespace Mzm\HtmlBuilder\Enums;

enum ButtonType: string
{
    case BUTTON = 'button';
    case SUBMIT = 'submit';
    case RESET = 'reset';

    public function label(): string
    {
        return match ($this) {
            self::BUTTON => 'Button',
            self::SUBMIT => 'Submit',
            self::RESET => 'Reset',
        };
    }
}
