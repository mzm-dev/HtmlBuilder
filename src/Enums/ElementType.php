<?php

namespace Mzm\HtmlBuilder\Enums;

enum ElementType: string
{
    case TextBlock = 'text-block';
    case InputNumber = 'input-number';
    case InputText = 'input-text';
    case InputEmail = 'input-email';
    case InputTextarea = 'input-textarea-input';
    case InputDate = 'input-date';
    case InputSelect = 'input-select-input';
    case InputRadio = 'input-radio-buttons';
    case InputCheckbox = 'input-checkbox-buttons';
    case Separator = 'separator';
    case Button = 'button';


    public function config(): array
    {
        return match ($this) {
            self::TextBlock => [
                'component' => 'mzm-html-builder::options.text-block',
                'rules' => [],
            ],
            self::InputNumber => [
                'component' => 'mzm-html-builder::options.input-number',
                'rules' => ['required', 'required-if', 'between', 'gt', 'regex'],
            ],
            self::InputText => [
                'component' => 'mzm-html-builder::options.input',
                'rules' => ['required', 'required-if', 'regex'],
            ],
            self::InputEmail => [
                'component' => 'mzm-html-builder::options.input',
                'rules' => ['required', 'required-if', 'regex'],
            ],
            self::InputTextarea => [
                'component' => 'mzm-html-builder::options.input',
                'rules' => ['required', 'required-if', 'regex'],
            ],
            self::InputDate => [
                'component' => 'mzm-html-builder::options.input',
                'rules' => ['required', 'required-if'],
            ],
            self::InputSelect => [
                'component' => 'mzm-html-builder::options.input-options',
                'rules' => ['required']
            ],
            self::InputRadio => [
                'component' => 'mzm-html-builder::options.input-options',
                'rules' => ['required']
            ],
            self::InputCheckbox => [
                'component' => 'mzm-html-builder::options.input-options',
                'rules' => ['required']
            ],
            self::Separator => [
                'component' => 'mzm-html-builder::options.separator',
                'rules' => [],
            ],
            self::Button => [
                'component' => 'mzm-html-builder::options.button',
                'rules' => [],
            ],
        };
    }
}
