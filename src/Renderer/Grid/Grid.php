<?php

namespace Obelaw\UI\Renderer\Grid;

use Livewire\Component;

class Grid
{
    public $bottoms = null;
    public $actions = null;

    protected $model = null;
    protected $where = null;

    public function __construct(
        public Component $grid,
    ) {
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function setWhere($where)
    {
        $this->where = $where;

        return $this;
    }

    public function setBottoms($bottoms)
    {
        $this->bottoms = $bottoms;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    public function table()
    {
        return new Table($this->grid, $this->model, $this->where);
    }
}
