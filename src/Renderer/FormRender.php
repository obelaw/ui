<?php

namespace Obelaw\UI\Renderer;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Obelaw\Facades\Bundles;
use Obelaw\Permissions\Traits\BootPermission;
use Obelaw\UI\Views\Layout\DashboardLayout;

abstract class FormRender extends Component
{
    use BootPermission;
    use LivewireAlert;

    public $inputs = [];
    public $actions = [];
    public $choices = [];

    protected $formId = null;
    protected $pretitle = 'Pre Title';
    protected $title = 'Title';

    private $fields = [];

    public function booted()
    {
        $this->bootPermission();

        $this->fields = Bundles::getFormFields($this->formId); // TODO remove this line
        $this->actions = Bundles::getFormActions($this->formId);

        foreach (Bundles::getFormTabs($this->formId) as $tab) {
            $this->fields = array_merge($this->fields, $tab['fields']);
        }

        foreach ($this->fields as $field) {
            $this->{'inputs.' . $field['model']} = $field['value'] ?? null;
        }
    }

    public function preTitle()
    {
        return Str::contains($this->pretitle, '::forms') ? __($this->pretitle) : $this->pretitle;
    }

    public function title()
    {
        return Str::contains($this->title, '::forms') ? __($this->title) : $this->title;
    }

    protected function rules()
    {
        $data = [];

        foreach ($this->fields as $field) {
            $data['inputs.' . $field['model']] = $field['rules'];
        }

        return $data;
    }

    public function render()
    {
        return view('obelaw-ui::renderer.form', [
            'pretitle' => $this->preTitle(),
            'title' => $this->title(),
            'formId' => $this->formId,
            'fields' => $this->fields,
            'choices' => $this->choices,
        ])->layout(DashboardLayout::class);
    }

    public function getInputs(string $key = null)
    {
        $inputs = $this->validate()['inputs'] ?? [];

        if ($key) {
            return $inputs[$key] ?? null;
        }

        return $inputs;
    }

    public function setInputs(array $inputs = [])
    {
        return $this->inputs = $inputs ?? [];
    }

    public function submit()
    {
        $validateData = $this->validate();

        $this->doSubmit($validateData);
    }

    protected function pushAlert($type = 'success', $massage)
    {
        $this->alert($type, $massage, [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    protected function pushFlash($type = 'success', $massage = 'Massage')
    {
        session()->flash('obelaw-' . $type, $massage);
    }

    public function setChoices(string $model, array $option)
    {
        $this->choices[$model] = $option;
    }
}
