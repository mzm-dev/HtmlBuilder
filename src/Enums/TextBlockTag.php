<?php

namespace Mzm\HtmlBuilder\Enums;

enum TextBlockTag: string
{
    case P = 'p';
    case H1 = 'h1';
    case H2 = 'h2';
    case H3 = 'h3';
    case H4 = 'h4';
    case H5 = 'h5';
    case H6 = 'h6';
    case BLOCKQUOTE = 'blockquote';
    case ADDRESS = 'address';

    public function label(): string
    {
        return match ($this) {
            self::P => 'Paragraph',
            self::BLOCKQUOTE => 'Blockquote',
            self::ADDRESS => 'Address',
            default => strtoupper($this->value),
        };
    }
}
