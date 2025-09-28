<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class FormHome extends Component
{
    use WithPagination;

    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {

        return view('mzm-html-builder::livewire.form-home');
    }
}
