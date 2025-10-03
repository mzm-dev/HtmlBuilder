<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Mzm\HtmlBuilder\Models\FormBuilderResponse;

class FormResponse extends Component
{
    use WithPagination;

    public ?FormBuilderForm $form;

    public function mount(FormBuilderForm $form) {
        $this->form = $form;
    }

    // Gunakan #[Layout] untuk menentukan layout secara langsung
    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {
        $responses = FormBuilderResponse::with('form')->where('form_id', $this->form->id)->paginate();

        return view('mzm-html-builder::livewire.form-response', [
            'responses' => $responses,
        ]);
    }
}
