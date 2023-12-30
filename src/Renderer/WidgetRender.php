<?php

namespace Obelaw\UI\Renderer;

use Illuminate\Support\Str;
use Livewire\Component;
use Obelaw\Facades\Bundles;
use Obelaw\UI\Views\Layout\DashboardLayout;

abstract class WidgetRender extends Component
{
    protected $pretitle = 'Pre Title View';
    protected $title = 'Title View';

    protected $widgetId = null;

    private $widget = null;

    public function boot()
    {
        $this->widgets = Bundles::getWidgets($this->widgetId);
    }

    public function preTitle()
    {
        return Str::contains($this->pretitle, '::views') ? __($this->pretitle) : $this->pretitle;
    }

    public function title()
    {
        return Str::contains($this->title, '::views') ? __($this->title) : $this->title;
    }

    public function render()
    {
        return view('obelaw-ui::renderer.widget', [
            'pretitle' => $this->preTitle(),
            'title' => $this->title(),
            'widget_id' => $this->widgetId,
            'widgets' => $this->widgets,
        ])->layout(DashboardLayout::class);
    }

    protected function parameters(array $parameters = [])
    {
        $this->parameters = $parameters;
    }
}
