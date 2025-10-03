<?php

namespace Mzm\HtmlBuilder\Enums;

enum ElementWidth: string
{
    case SPAN_1 = '1';
    case SPAN_2 = '2';
    case SPAN_3 = '3';
    case SPAN_4 = '4';

    public function label(): string
    {
        return match ($this) {
            self::SPAN_1 => '1/4 Column',
            self::SPAN_2 => '2/4 Column',
            self::SPAN_3 => '3/4 Column',
            self::SPAN_4 => 'Full Width',
        };
    }
}
