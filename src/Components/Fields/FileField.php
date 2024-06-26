<?php

namespace Obelaw\UI\Components\Fields;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class FileField extends Component
{
    public function __construct(
        public $label = 'set label',
        public $placeholder = '',
        public $model = 'set name',
        public $hint = null,
        public $required = false,
        public $multiple = false,
    ) {
        $this->label = Str::contains($label, '::forms') ? __($label) : $label;
        $this->placeholder = Str::contains($placeholder, '::forms') ? __($placeholder) : $placeholder;
        $this->hint = Str::contains($hint, '::forms') ? __($hint) : $hint;
    }

    public function render()
    {
        return view('obelaw-ui::components.fields.file');
    }
}
