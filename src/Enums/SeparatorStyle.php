<?php

namespace Mzm\HtmlBuilder\Enums;

enum SeparatorStyle: string
{
    case NONE = 'none';
    case SOLID = 'solid';
    case DOTTED = 'dotted';
    case DASHED = 'dashed';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
