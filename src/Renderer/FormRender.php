<?php

namespace Obelaw\UI\Renderer;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Obelaw\Facades\Bundles;
use Obelaw\UI\Permissions\Traits\BootPermission;
use Obelaw\UI\Views\Layout\DashboardLayout;

abstract class FormRender extends Component
{
    use BootPermission;
    use LivewireAlert;

    protected $pretitle = 'Pre Title';
    protected $title = 'Title';

    private $fields = [];

    public function boot()
    {
        $this->bootPermission();

        $this->fields = Bundles::getForms($this->formId);

        foreach ($this->fields as $field) {
            $this->{$field['model']} = $field['value'] ?? null;
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
            $data[$field['model']] = $field['rules'];
        }

        return $data;
    }

    public function render()
    {
        return view('obelaw-ui::renderer.form', [
            'pretitle' => $this->preTitle(),
            'title' => $this->title(),
        ])->layout(DashboardLayout::class);
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
}