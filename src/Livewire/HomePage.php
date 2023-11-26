<?php

namespace Obelaw\UI\Livewire;

use Obelaw\Facades\Bundles;
use Obelaw\UI\Views\Containers\HomePageContainer;
use Obelaw\UI\Views\Layout\DashboardLayout;

class HomePage extends HomePageContainer
{
    public function render()
    {
        $modules = collect(Bundles::getModules());
        $mainModules = $modules->where('helper', false)->all();
        $helperModules = $modules->where('helper', true)->all();

        return view('obelaw-ui::pages.home', [
            'modules' => $mainModules,
            'helperModules' => $helperModules,
        ])->layout(DashboardLayout::class);
    }
}
