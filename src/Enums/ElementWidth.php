<?php

namespace Mzm\HtmlBuilder\Enums;

enum ElementWidth: string
{
    case SPAN_1 = '1';
    case SPAN_2 = '2';
    case SPAN_3 = '3';
    case SPAN_4 = '4';
    case SPAN_5 = '5';
    case SPAN_6 = '6';
    case SPAN_7 = '7';
    case SPAN_8 = '8';
    case SPAN_9 = '9';
    case SPAN_10 = '10';
    case SPAN_11 = '11';
    case SPAN_12 = '12';

    public function label(): string
    {
        return match ($this) {
            self::SPAN_1 => 'cols-1',
            self::SPAN_2 => 'cols-2',
            self::SPAN_3 => 'cols-3',
            self::SPAN_4 => 'cols-4',
            self::SPAN_5 => 'cols-5',
            self::SPAN_6 => 'cols-6',
            self::SPAN_7 => 'cols-7',
            self::SPAN_8 => 'cols-8',
            self::SPAN_9 => 'cols-9',
            self::SPAN_10 => 'cols-10',
            self::SPAN_11 => 'cols-11',
            self::SPAN_12 => 'cols-12',
        };
    }
}
