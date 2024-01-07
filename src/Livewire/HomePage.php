<?php

namespace Obelaw\UI\Livewire;

use Livewire\Component;
use Obelaw\Facades\Bundles;
use Obelaw\UI\Views\Layout\DashboardLayout;

class HomePage extends Component
{
    public function render()
    {
        return view('obelaw-ui::pages.home', [
            'modules' => Bundles::getModulesByGroup(),
        ])->layout(DashboardLayout::class);
    }
}
