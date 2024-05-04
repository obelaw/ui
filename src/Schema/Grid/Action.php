<?php

namespace Obelaw\UI\Schema\Grid;

class Action
{
    private $actions = [];

    public function addAction(string $alias)
    {
        array_push($this->actions, $alias);
    }

    public function getActions()
    {
        return $this->actions;
    }
}
