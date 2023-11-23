<?php

namespace Obelaw\UI\Views\Layout;

use Illuminate\View\Component;
use Illuminate\View\View;
use Obelaw\Facades\Bundles;

class DashboardLayout extends Component
{
    /**
     * The list of modules.
     *
     * @var array
     */
    public $modules = null;

    /**
     * The list of helper modules.
     *
     * @var array
     */
    public $helperModules = null;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct()
    {
        $modules = collect(Bundles::getModules());
        $this->modules = $modules->where('helper', false)->all();
        $this->helperModules = $modules->where('helper', true)->all();
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('obelaw-ui::layouts.dashboard');
    }
}
