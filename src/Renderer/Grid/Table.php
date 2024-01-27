<?php

namespace Obelaw\UI\Renderer\Grid;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Table
{
    public $labels = [];
    public $dataKeys = [];
    public $bottoms = null;
    public $actions = null;
    public $setCTAs = null;
    public $model = null;
    public $where = null;
    public $grid = null;
    public $filter = null;
    public $links = null;

    public function __construct($model, $where = null, $grid = null)
    {
        $this->model = $model;
        $this->where = $where;
        $this->grid = $grid;
    }

    public function addColumn($label, $dataKey, $filter = null)
    {
        array_push($this->labels, Str::contains($label, '::grids') ? __($label) : $label);
        array_push($this->dataKeys, ['key' => $dataKey, 'filter' => $filter]);

        return $this;
    }

    public function getLabels()
    {
        return $this->labels;
    }

    public function getDataKeys()
    {
        return $this->dataKeys;
    }

    public function setBottoms($bottoms)
    {
        $this->bottoms = $bottoms;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    public function setCTAs($calls)
    {
        $this->setCTAs = $calls;
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function initFilter($filterClass)
    {
        if ($filterClass) {
            $this->filter = new $filterClass;
        }
    }

    public function getRows()
    {

        // dd($this->grid, method_exists($this->grid, 'where'));

        $model = (new $this->model)->where(function (Builder $query) {
            if ($this->where) {
                $query->where((new $this->where)->where($query));
            }

            if (method_exists($this->grid, 'where')) {
                $query->where($this->grid->where($query));
            }
        })->paginate(25);

        $this->links = $model->links();

        return $model->map(function ($row) {
            $rows = [];

            $rows['primary'] = $row->id;

            foreach ($this->getDataKeys() as $column) {
                $rows['columns'][] = (!is_null($column['filter'])) ?
                    call_user_func_array([$this->filter, $column['filter']], [$row->{$column['key']}, $row]) :
                    $row->{$column['key']};
            }

            $rows['calls'] = $this->setCTAs;
            return $rows;
        });
    }
}
