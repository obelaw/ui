<?php

namespace Obelaw\UI\Livewire;

use Obelaw\Facades\Bundles;
use Obelaw\UI\Views\Containers\HomePageContainer;
use Obelaw\UI\Views\Layout\DashboardLayout;

class HomePage extends HomePageContainer
{
    public function render()
    {
        return view('obelaw-ui::pages.home', [
            'modules' => Bundles::getModulesByGroup(),
        ])->layout(DashboardLayout::class);
    }
}
