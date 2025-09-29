<?php

namespace Mzm\HtmlBuilder\Http\Livewire;

use Livewire\Component;
use Mzm\HtmlBuilder\Models\FormBuilderForm;
use Livewire\Attributes\Layout;

class FormBuilder extends Component
{
    public $formElements = [];
    public $editingElementData = [];
    public $formId;
    public $formTitle = 'My New Form';
    public $formDescriptions = 'My New Form Descriptions';

    public function mount($formId = null, $initialData = [])
    {
        if ($formId) {
            $form = FormBuilderForm::findOrFail($formId);
            $this->formId = $form->id;
            $this->formTitle = $form->title;
            $this->formDescriptions = $form->descriptions;
            $this->formElements = $form->elements;
        } else {
            $this->formElements = $initialData;
        }
    }

    public function addElement($type, $options = null)
    {
        $newElement = [
            'id' => uniqid(),
            'type' => $type,
            'label' => 'New ' . ucfirst($type),
            'placeholder' => '',
            'colspan' => '4',
            'attr' => $type === 'text-block' ? 'p' : null,
            'options' => $options ? [
                ['value' => 'value1', 'label' => 'Option 1'],
                ['value' => 'value2', 'label' => 'Option 2'],
                ['value' => 'value3', 'label' => 'Option 3']
            ] : [],
            'attributes' => $type === 'button' ? [
                'color' => 'green',
                'type' => 'button',
                'class' => $this->generateButtonClasses('green'),
            ] : [],
        ];
        $this->formElements[] = $newElement;
    }

    public function editElement($id)
    {
        $this->editingElementData = collect($this->formElements)->firstWhere('id', $id);
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
    }


    public function saveElement()
    {
        $index = collect($this->formElements)->search(fn($element) => $element['id'] === $this->editingElementData['id']);
        if ($this->editingElementData['type'] === 'button' && isset($this->editingElementData['attributes']['color'])) {
            $color = $this->editingElementData['attributes']['color'];
            $this->editingElementData['attributes']['class'] = $this->generateButtonClasses($color);
        }

        if ($index !== false) {
            $this->formElements[$index] = $this->editingElementData;
        }

        $this->editingElementData = [];
        $this->dispatch('hide-edit-modal');
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
    }

    private function generateButtonClasses(string $color): string
    {
        $baseClasses = '';

        $colorClasses = "text-white bg-{$color}-700 hover:bg-{$color}-800 focus:ring-4 focus:ring-{$color}-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-{$color}-600 dark:hover:bg-{$color}-700 focus:outline-none dark:focus:ring-{$color}-800";

        return "{$baseClasses} {$colorClasses}";
    }

    // Gunakan #[Layout] untuk menentukan layout secara langsung
    #[Layout('mzm-html-builder::components.layouts.form-builder')]
    public function render()
    {
        return view('mzm-html-builder::livewire.form-builder');
    }
}
