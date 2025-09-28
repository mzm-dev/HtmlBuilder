<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class FormList extends Component
{
    use WithPagination;

    // Gunakan #[Layout] untuk menentukan layout secara langsung
    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {
        $forms = FormBuilderForm::paginate();

        return view('mzm-html-builder::livewire.form-list', [
            'forms' => $forms,
        ]);
    }

    public function deleteForm(FormBuilderForm $form)
    {
        $form->delete();
        $this->dispatch('deletedForm', message: 'Form deleted successfully!');
    }
}
