<?php

namespace Obelaw\UI\Components\Groups;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SmallGroup extends Component
{
    public function __construct(
        public Collection $modules,
    ) {
    }

    public function render()
    {
        return view('obelaw-ui::components.groups.small');
    }
}
