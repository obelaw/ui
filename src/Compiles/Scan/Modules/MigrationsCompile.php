<?php

namespace Obelaw\UI\Compiles\Scan\Modules;

use Obelaw\Compiles\Abstracts\Compile;

class MigrationsCompile extends Compile
{
    public $driverKey = 'obelawMigration';

    public function scanner($paths)
    {
        $outoutMigrations = [];


        foreach ($paths as $id => $path) {
            $pathInfoFile = $path . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . 'migrations.php';

            if (file_exists($pathInfoFile)) {
                $outoutMigrations = array_merge($outoutMigrations, require $pathInfoFile);
            }
        }

        return $outoutMigrations;
    }
}
