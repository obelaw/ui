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
    public $moduleGroups = null;

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
        $this->moduleGroups = Bundles::getModulesByGroup();
    }
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('obelaw-ui::layouts.dashboard');
    }
}
