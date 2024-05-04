<?php

namespace Obelaw\UI\Compiles\Scan\Modules;

use Obelaw\Compiles\Abstracts\Compile;
use Obelaw\UI\Schema\View\Button;
use Obelaw\UI\Schema\View\Tabs;

class ViewsCompile extends Compile
{
    public $driverKey = 'obelawViews';

    public function scanner($paths)
    {
        $outViews = [];


        foreach ($paths as $id => $path) {
            $_view = [];

            if (is_dir($path . DIRECTORY_SEPARATOR . 'etc/views')) {

                foreach (glob($path . DIRECTORY_SEPARATOR . 'etc/views/*.php') as $filename) {
                    $viewClass = require $filename;
                    $viewClass = new $viewClass;

                    //Columns class
                    $tabs = new Tabs;
                    $buttons = new Button;

                    $viewClass->tabs($tabs);

                    if (method_exists($viewClass, 'magicButtons')) {
                        $viewClass->magicButtons($buttons);
                    }

                    $_view[$id . '_' . basename($filename, '.php')] = [
                        'tabs' => $tabs->getTabs(),
                        'buttons' => (method_exists($viewClass, 'magicButtons')) ? $buttons->getButtons() : null,
                    ];
                }

                $outViews = array_merge($outViews, $_view);
            }
        }

        return $outViews;
    }
}
