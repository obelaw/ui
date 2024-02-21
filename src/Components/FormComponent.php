<?php

namespace Obelaw\UI\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Obelaw\Facades\Bundles;

class FormComponent extends Component
{
    public $fields = [];
    public $tabs = [];

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($id = null)
    {
        $this->fields = Bundles::getFormFields($id);
        $this->tabs = Bundles::getFormTabs($id);
    }
    
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('obelaw-ui::components.form');
    }
}
