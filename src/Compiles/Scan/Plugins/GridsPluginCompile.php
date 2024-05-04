<?php

namespace Obelaw\UI\Compiles\Scan\Plugins;

use Obelaw\Facades\Bundles;
use Obelaw\UI\Schema\Grid\Action;
use Obelaw\UI\Schema\Grid\Button;
use Obelaw\UI\Schema\Grid\CTA;
use Obelaw\UI\Schema\Grid\Table;
use Obelaw\UI\Compiles\Scan\Modules\GridsCompile;

class GridsPluginCompile extends GridsCompile
{
    public function scanner($paths)
    {
        $outGrids = Bundles::getGrids();

        foreach ($paths as $id => $path) {
            $_grid = [];

            if (is_dir($path . DIRECTORY_SEPARATOR . 'etc/grids')) {

                foreach (glob($path . DIRECTORY_SEPARATOR . 'etc/grids/*.php') as $filename) {
                    $gridClass = include($filename);

                    //Columns class
                    $table = new Table;
                    $CTA = new CTA;
                    $button = new Button;
                    $actions = new Action;

                    if (method_exists($gridClass, 'createButton')) {
                        $gridClass->createButton($button);
                    }

                    if (method_exists($gridClass, 'actions')) {
                        $gridClass->actions($actions);
                    }

                    $gridClass->table($table);
                    $gridClass->CTA($CTA);

                    $_grid[$id . '_' . basename($filename, '.php')] = [
                        'model' => (property_exists($gridClass, 'model')) ? $gridClass->model : null,
                        'where' => (property_exists($gridClass, 'where')) ? $gridClass->where : null,
                        'filter' => (property_exists($gridClass, 'filter')) ? $gridClass->filter : null,
                        'buttons' => $button->getButtons(),
                        'actions' => $actions->getActions(),
                        'rows' => $table->getColumns(),
                        'CTAs' => $CTA->getCalls(),
                    ];
                }

                $outGrids = array_merge($outGrids, $_grid);
            }
        }

        return $outGrids;
    }
}
