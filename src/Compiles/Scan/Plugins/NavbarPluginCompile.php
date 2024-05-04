<?php

namespace Obelaw\UI\Compiles\Scan\Plugins;

use Obelaw\Facades\Bundles;
use Obelaw\UI\Schema\Navbar\Links;
use Obelaw\UI\Compiles\Scan\Modules\NavbarCompile;

class NavbarPluginCompile extends NavbarCompile
{
    public function scanner($paths)
    {
        $outNavbars = Bundles::getNavbars();

        foreach ($paths as $id => $path) {
            $pathNavbarFile = $path . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . 'navbar.php';

            if (file_exists($pathNavbarFile)) {
                $navbar = require $pathNavbarFile;
                $navbar = new $navbar;

                $link = new Links;

                $navbar->navbar($link);

                if (property_exists($navbar, 'appendTo')) {
                    foreach ($navbar->appendTo as $appendTo) {
                        if (isset($outNavbars[$appendTo])) {

                            foreach ($outNavbars[$appendTo] as $_id => $_navbar) {
                                foreach ($link->getPushLink() as $pushId => $pushLink) {
                                    if (isset($_navbar['id']) && $_navbar['id'] == $pushId) {
                                        array_push($outNavbars[$appendTo][$_id]['sublinks'], $pushLink);
                                    }
                                }
                            }

                            $outNavbars[$appendTo] = array_merge($outNavbars[$appendTo], $link->getLinks());
                        }
                    }
                }
            }
        }

        return $outNavbars;
    }
}
