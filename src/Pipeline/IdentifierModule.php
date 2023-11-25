<?php

namespace Obelaw\UI\Pipeline;

class IdentifierModule
{
    public static $module = null;

    public static function setModule(array $module)
    {
        static::$module = $module;
    }

    public static function getModule()
    {
        return static::$module;
    }
}
