<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;

class FormBuilder extends Component
{
    public $formElements = [];
    public $editingElementData = [];
    public $formId;
    public $formTitle = 'My New Form';
    public $formDescriptions = 'My New Form Descriptions';
    public $previewData = [];
    public $presence = 'optional'; // Properti baru untuk radio button

    public function mount($formId = null, $initialData = [])
    {
        if ($formId) {
            $form = FormBuilderForm::findOrFail($formId);
            $this->formId = $form->id;
            $this->formTitle = $form->title;
            $this->formDescriptions = $form->descriptions;
            $this->formElements = $form->elements;
            foreach ($this->formElements as $element) { // Assign dynamic variable on previewData
                switch ($element['type']) {
                    case 'input-text':
                    case 'email':
                    case 'input-number':
                    case 'input-date':
                    case 'textarea-input':
                    case 'input-select-input':
                    case 'input-radio-buttons':
                    case 'input-checkbox-buttons':
                        $this->previewData[$element['id']] = null;
                        break;
                }
            }
        } else {
            $this->formElements = $initialData;
        }
    }

    public function addElement($type, $options = null)
    {
        $newElement = [
            'id' => uniqid('element-'),
            'type' => $type,
            'label' => 'New ' . ucfirst($type),
            'placeholder' => '',
            'helpText' => '',
            'colspan' => '4',
            'attr' => $type === 'text-block' ? 'p' : null,
            'options' => $options ? [
                ['value' => 'value1', 'label' => 'Option 1'],
                ['value' => 'value2', 'label' => 'Option 2'],
                ['value' => 'value3', 'label' => 'Option 3']
            ] : [],
            'attributes' =>  [
                'color' => null,
                'type' =>  null,
                'class' =>  null,
            ],
            // 'attributes' => $type === 'button' ? [
            //     'color' => 'green',
            //     'type' => 'button',
            //     'class' => $this->generateButtonClasses('green'),
            // ] : [],
        ];
        $this->formElements[] = $newElement;
    }

    public function editElement($id)
    {
        $this->editingElementData = collect($this->formElements)->firstWhere('id', $id);

        // Inisialisasi properti 'presence' berdasarkan data yang ada
        if (isset($this->editingElementData['validation']['required']) && $this->editingElementData['validation']['required'] === true) {
            $this->presence = 'required';
        } elseif (isset($this->editingElementData['validation']['nullable']) && $this->editingElementData['validation']['nullable'] === true) {
            $this->presence = 'nullable';
        } else {
            $this->presence = 'optional';
        }
        $this->dispatch('show-edit-modal');
    }

    public function duplicateElement($elementId)
    {
        $elementIndex = null;
        // 1. Find the index of the element we want to duplicate
        foreach ($this->formElements as $index => $element) {
            if ($element['id'] === $elementId) {
                $elementIndex = $index;
                break;
            }
        }

        // 2. If the element is found...
        if ($elementIndex !== null) {
            // 3. Make a copy of the element's data
            $elementToDuplicate = $this->formElements[$elementIndex];
            $newElement = $elementToDuplicate;

            // 4. Assign a new, unique ID to the copy
            $newElement['id'] = uniqid('element-');

            // 5. Insert the new element into the array right after the original
            array_splice($this->formElements, $elementIndex + 1, 0, [$newElement]);
        }
    }

    public function moveElement($elementId, $direction)
    {
        $elementIndex = -1;
        foreach ($this->formElements as $index => $element) {
            if ($element['id'] === $elementId) {
                $elementIndex = $index;
                break;
            }
        }

        if ($elementIndex === -1) {
            return;
        }

        $newIndex = $direction === 'up' ? $elementIndex - 1 : $elementIndex + 1;

        // Ensure the new index is within the array bounds
        if ($newIndex < 0 || $newIndex >= count($this->formElements)) {
            return;
        }

        // Swap the elements
        $elementToMove = $this->formElements[$elementIndex];
        array_splice($this->formElements, $elementIndex, 1);
        array_splice($this->formElements, $newIndex, 0, [$elementToMove]);

        // Automatically save the entire form if it already exists
        $this->persistFormChanges();
    }

    // In your App\Http\Livewire\FormBuilder.php or similar file:

    public function moveOption($index, $direction)
    {
        $options = $this->editingElementData['options'];
        $count = count($options);
        $newIndex = $direction === 'up' ? $index - 1 : $index + 1;

        // Ensure the new index is within the array bounds
        if ($newIndex < 0 || $newIndex >= $count) {
            return;
        }

        // Swap the elements
        $optionToMove = $options[$index];
        $options[$index] = $options[$newIndex];
        $options[$newIndex] = $optionToMove;

        $this->editingElementData['options'] = $options;

        // Automatically save the entire form if it already exists
        $this->persistFormChanges();
    }


    public function saveElement()
    {
        $index = collect($this->formElements)->search(fn($element) => $element['id'] === $this->editingElementData['id']);

        if ($index !== false) {
            $this->formElements[$index] = $this->editingElementData;
        }

        $this->editingElementData = [];
        $this->dispatch('hide-edit-modal');

        // Automatically save the entire form if it already exists
        $this->persistFormChanges();
    }

    public function addOption()
    {
        $this->editingElementData['options'][] = ['value' => '', 'label' => ''];
    }

    public function removeOption($index)
    {
        unset($this->editingElementData['options'][$index]);
        $this->editingElementData['options'] = array_values($this->editingElementData['options']);
    }

    /**
     * Lifecycle hook yang dipanggil saat properti 'presence' diperbarui.
     * Ini akan mengatur aturan validasi 'required' dan 'nullable'.
     */
    public function updatedPresence($value)
    {
        $this->editingElementData['validation']['required'] = ($value === 'required');
        $this->editingElementData['validation']['nullable'] = ($value === 'nullable');

        // Hapus kunci jika nilainya false untuk menjaga kebersihan data
        if (!$this->editingElementData['validation']['required']) unset($this->editingElementData['validation']['required']);
        if (!$this->editingElementData['validation']['nullable']) unset($this->editingElementData['validation']['nullable']);
    }


    public function saveForm()
    {
        $this->validate([
            'formTitle' => 'required|string|max:255',
            'formDescriptions' => 'nullable|string',
            'formElements' => 'present|array'
        ]);

        $formData = [
            'title' => $this->formTitle,
            'descriptions' => $this->formDescriptions,
            'elements' => $this->formElements,
        ];

        if ($this->formId) {
            $form = FormBuilderForm::findOrFail($this->formId);
            $form->update($formData);
            $this->dispatch('updatedForm',  message: 'Form updated successfully!');
        } else {
            $form = FormBuilderForm::create($formData);
            $this->formId = $form->id;
            $this->dispatch('createdForm', message: 'Form saved successfully!', formid: $this->formId);
        }
    }

    public function deleteElement($id)
    {
        $this->formElements = array_values(array_filter($this->formElements, function ($element) use ($id) {
            return $element['id'] !== $id;
        }));

        // Automatically save the entire form if it already exists
        $this->persistFormChanges();
    }

    /**
     * Persists the current state of the form to the database without dispatching events.
     * This is used for auto-saving when an element is updated.
     */
    private function persistFormChanges()
    {
        if ($this->formId) {
            FormBuilderForm::where('id', $this->formId)->update([
                'elements' => $this->formElements,
            ]);
        }
    }

    public function validatePreview()
    {
        $rules = [];
        $attributes = [];

        foreach ($this->formElements as $element) {
            // Hanya validasi elemen yang memiliki 'name' dan 'validation'
            if (!empty($element['id']) && !empty($element['validation'])) {
                $key = 'previewData.' . $element['id'];
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
                $attributes[$key] = $element['label'];
            }
        }

        if (empty($rules)) {
            // Tidak ada yang perlu divalidasi, mungkin tampilkan pesan sukses
            $this->dispatch('validation-success', message: 'No validation rules to check. (rules is empty)');
            return;
        }

        try {
            $this->validate($rules, messages: [], attributes: $attributes);
            // Jika validasi berhasil, tampilkan pesan sukses
            $this->dispatch('validation-success', message: 'Validation passed successfully!');
        } catch (ValidationException $e) {
            // Biarkan Livewire menangani tampilan error, tetapi kita bisa menangkapnya jika perlu tindakan kustom
            // Tidak perlu melakukan apa-apa di sini karena Livewire akan secara otomatis menampilkan error
            throw $e;
        }
    }
    public function resetPreviewForm()
    {
        $this->previewData = [];
        $this->resetPreviewValidation();
    }

    public function resetPreviewValidation()
    {
        $this->resetValidation();
    }

    // Gunakan #[Layout] untuk menentukan layout secara langsung
    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {
        return view('mzm-html-builder::livewire.form-builder');
    }
}
