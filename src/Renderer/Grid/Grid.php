<?php

namespace Obelaw\UI\Renderer\Grid;

class Grid
{
    public static function model($model = null, $where = null, $grid)
    {
        return new Table($model, $where, $grid);
    }
}
