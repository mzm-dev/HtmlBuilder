<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;
use Mzm\HtmlBuilder\Models\FormBuilderResponse;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class FormResponse extends Component
{
    use WithPagination;

    public ?FormBuilderForm $form;

    public $inputElements;

    // Properties for the modal
    public bool $showModal = false;
    public array $selectedResponseDetails = [];

    public function mount(FormBuilderForm $form)
    {
        $this->form = $form;

        $this->inputElements = collect($this->form->elements)
            ->filter(fn($el) => Str::startsWith($el['type'], 'input-'))->pluck('label', 'id');
    }

    #[On('view-response')]
    public function viewResponse(FormBuilderResponse $response)
    {

        if (!$response) {
            // Handle jika respons tidak ditemui, mungkin dengan dispatch event error
            return;
        }

        $combinedData = [];
        $responseValues = collect($response->data);

        // Gabungkan label dari $this->inputElements dengan nilai dari respons
        foreach ($this->inputElements as $key => $label) {
            if ($responseValues->has($key)) {
                $value = $responseValues->get($key);
                // Format nilai boolean untuk paparan yang lebih mesra pengguna
                if (is_bool($value)) {
                    $value = $value ? 'Ya' : 'Tidak';
                }
                $combinedData[$label] = $value ?? '-';
            }
        }

        $this->selectedResponseDetails = $combinedData;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset('selectedResponseDetails');
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
