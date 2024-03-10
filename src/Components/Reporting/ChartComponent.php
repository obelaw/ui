<?php

namespace Obelaw\UI\Components\Reporting;

use Illuminate\View\Component;
use Illuminate\View\View;

class ChartComponent extends Component
{
    /**
     * Create the component instance.
     *
     * @param  string  $id
     * @return void
     */
    public function __construct(public $id = null)
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('obelaw-ui::components.reporting.chart');
    }
}
