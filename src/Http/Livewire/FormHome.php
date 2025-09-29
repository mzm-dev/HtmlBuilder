<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mzm\HtmlBuilder\Models\FormBuilderResponse;

class FormHome extends Component
{
    use WithPagination;

    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {
        $forms = FormBuilderForm::count();
        $responses = FormBuilderResponse::count();

        return view('mzm-html-builder::livewire.form-home', [
            'forms' => $forms,
            'responses' => $responses,
        ]);
    }
}
