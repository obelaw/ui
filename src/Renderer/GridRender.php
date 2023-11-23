<?php

namespace Obelaw\UI\Renderer;

use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Obelaw\Facades\Bundles;
use Obelaw\Framework\ACL\Attributes\PermissionDelete;
use Obelaw\Framework\ACL\Permission;
use Obelaw\Framework\ACL\Traits\BootPermission;
use Obelaw\Framework\Builder\Grid;
use Obelaw\UI\Views\Layout\DashboardLayout;
use ReflectionMethod;

abstract class GridRender extends Component
{
    use BootPermission;
    use WithPagination;

    protected $pretitle = 'Pre Title';
    protected $title = 'Title';
    protected $paginationTheme = 'bootstrap';

    private $grid = null;

    public function boot()
    {
        $this->bootPermission();

        $grid = Bundles::getGrids($this->gridId);

        $gridBuild = Grid::model($grid['model'], $grid['where']);

        $gridBuild->setBottoms($grid['buttons']);

        foreach ($grid['rows'] as $row) {
            $gridBuild->addColumn($row['label'], $row['dataKey'], $row['filter']);
        }

        $gridBuild->setCTAs($grid['CTAs']);
        $gridBuild->initFilter($grid['filter']);

        $this->grid = $gridBuild;
    }

    public function preTitle()
    {
        return Str::contains($this->pretitle, '::grids') ? __($this->pretitle) : $this->pretitle;
    }

    public function title()
    {
        return Str::contains($this->title, '::grids') ? __($this->title) : $this->title;
    }

    public function render()
    {
        return view('obelaw-ui::renderer.grid', [
            'pretitle' => $this->preTitle(),
            'title' => $this->title(),
            'grid' => $this->grid,
            'canRemoveRow' => $this->canRemoveRow(),
        ])->layout(DashboardLayout::class);
    }

    private function canRemoveRow()
    {
        if (!method_exists($this, 'removeRow')) {
            return false;
        }

        $constructor = new ReflectionMethod($this, 'removeRow');
        $attributes = $constructor->getAttributes(PermissionDelete::class);

        foreach ($attributes as $attribute) {
            if (!Permission::verify($attribute->getArguments()[0])) {
                return false;
            }
        }

        return false;
    }
}
