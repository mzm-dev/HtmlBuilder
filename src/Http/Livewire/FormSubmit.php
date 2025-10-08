<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Mzm\HtmlBuilder\Models\FormBuilderResponse;

class FormSubmit extends Component
{

    public ?FormBuilderForm $form;

    public $fields;

    public $grids;
    public $renderBefore;
    public $renderAfter;
    public $authentication;

    public $terimaKasih = false;

    public array $responses = [];

    public function mount(FormBuilderForm $form)
    {
        $this->form = $form;

        $this->fields = $form->elements;

        $this->grids = $form->config['grids'] ?? ['col' => 4, 'gap' => 2];

        $this->renderBefore = $form->config['render']['before']
            && $form->config['render']['before']['enable']
            ? $form->config['render']['before'] : false;

        $this->renderAfter = $form->config['render']['after']
            && $form->config['render']['after']['enable']
            ? $form->config['render']['after'] : false;

        $this->authentication = $form->config['authentication'] ?? [];

        // Inisialkan array responses dengan nilai null
        foreach ($this->fields as $element) { // Only initialize elements that are inputs
            if (isset($element['id'])) {
                if (str_starts_with($element['type'], 'input-')) {
                    $this->responses[$element['id']] = null;
                }
            }
        }

        $this->dispatch(
            'render-before',
            title: $this->renderBefore['title'] ?? 'titletitle',
            body: $this->renderBefore['body'] ?? 'bodybody'
        );
    }

    public function rules()
    {
        $rules = [];
        foreach ($this->fields as $element) {
            // Hanya validasi elemen yang memiliki 'name' dan 'validation'
            if (!empty($element['id']) && !empty($element['validation'])) {
                $key = 'responses.' . $element['id'];
                $elementRules = [];
                if (is_array($element['validation'])) {
                    foreach ($element['validation'] as $rule => $parameter) {
                        if ($parameter !== false && $parameter !== null) {
                            if ($rule === 'required_if' && is_array($parameter)) {
                                // Handle required_if:field,value
                                if (isset($parameter['field']) && isset($parameter['value'])) {
                                    $elementRules[] = 'required_if:' . $parameter['field'] . ',' . $parameter['value'];
                                }
                            } elseif ($rule === 'required_with' && is_array($parameter)) {
                                // Handle required_with:field1,field2,...
                                if (!empty($parameter)) {
                                    $elementRules[] = 'required_with:' . implode(',', $parameter);
                                }
                            } elseif ($rule === 'regex' && !is_array($parameter)) {
                                // For regex, the pattern is the parameter.
                                $elementRules[] = 'regex:/' . $parameter . '/';
                            } elseif ($parameter === true) {
                                // For rules like 'required' => true
                                $elementRules[] = $rule;
                            } elseif (!is_array($parameter)) {
                                // For rules with simple parameters like 'min:5', 'max:10', 'gt:0', 'lt:100'
                                $elementRules[] = $rule . ':' . $parameter;
                            }
                        }
                    }
                }
                $rules[$key] = $elementRules;
                // $attributes[$key] = $element['label'];
            }
        }

        return $rules;
    }

    protected function messages()
    {
        return [];
    }

    protected function validationAttributes()
    {
        $attributes = [];

        foreach ($this->fields as $element) {
            if (!empty($element['id']) && !empty($element['validation'])) {
                $key = 'responses.' . $element['id'];
                $attributes[$key] = $element['label'];
            }
        }

        return $attributes;
    }

    /**
     * Simpan data borang.
     */
    public function save()
    {
        $this->validate();
        // Simpan ke pangkalan data
        FormBuilderResponse::create([
            'form_id' => $this->form->id,
            'data' => $this->responses,
        ]);

        // Reset borang dan tunjuk mesej berjaya
        $this->reset('responses');
        $this->dispatch(
            'render-after',
            title: $this->renderAfter['title'] ?? 'Borang telah berjaya dihantar!',
            body: $this->renderAfter['body'] ?? 'Borang telah berjaya dihantar!'
        );
    }

    public function redirectTo()
    {

        switch ($this->renderAfter['method']) {
            case 'route':
                return redirect()->route($this->renderAfter['value']);
                break;
            case 'to':
                return redirect()->to($this->renderAfter['value']);
                break;
            case 'away':
                return redirect()->away($this->renderAfter['value']);
                break;

            default:
                $this->terimaKasih = true;
                break;
        }
    }

    /**
     * Paparkan komponen.
     */
    // Gunakan #[Layout] untuk menentukan layout secara langsung
    #[Layout('mzm-html-builder::components.layouts.form-response')]
    public function render()
    {
        if ($this->terimaKasih) {
            return view('mzm-html-builder::livewire.form-terima-kasih');
        }
        return view('mzm-html-builder::livewire.form-submit');
    }
}
