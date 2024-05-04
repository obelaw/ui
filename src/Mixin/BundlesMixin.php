<?php

namespace Obelaw\UI\Mixin;

class BundlesMixin
{
    public function getForms()
    {
        return function ($id = null) {
            $forms = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawForms');

            if (!is_null($id)) {
                return $forms[$id] ?? null;
            }

            return $forms;
        };
    }

    public function getFormFields()
    {
        return function ($id) {
            return static::getForms($id)['fields'];
        };
    }

    public function getFormTabs()
    {
        return function ($id) {
            return static::getForms($id)['tabs'] ?? null;
        };
    }

    public function getFormActions()
    {
        return function ($id) {
            return static::getForms($id)['actions'];
        };
    }

    public function getGrids()
    {
        return function ($id = null) {
            $grids = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawGrids');

            if (!is_null($id)) {
                return $grids[$id] ?? null;
            }

            return $grids;
        };
    }

    public function getViews()
    {
        return function ($id = null) {
            $views = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawViews');

            if (!is_null($id)) {
                return $views[$id] ?? null;
            }

            return $views;
        };
    }

    public function getWidgets()
    {
        return function ($id = null) {
            $Widgets = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawWidgets');

            if (!is_null($id)) {
                return $Widgets[$id] ?? null;
            }

            return $Widgets;
        };
    }

    public function getDashboardRoutes()
    {
        return function () {
            $routes = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawDashboardRoutes');

            return $this->BundlesDisable($routes);
        };
    }

    public function getApiRoutes()
    {
        return function () {
            $routes = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawApiRoutes');

            return $this->BundlesDisable($routes);
        };
    }

    public function getNavbars()
    {
        return function ($id = null) {
            $navbars = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawNavbars');

            $navbars = $this->BundlesDisable($navbars);

            if (!is_null($id) && isset($navbars[$id])) {
                return $navbars[$id];
            }

            return $navbars;
        };
    }

    public function getACLs()
    {
        return function () {
            $ACLs = $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawACLs');

            return $this->BundlesDisable($ACLs);
        };
    }

    public function getMigrations()
    {
        return function () {
            return $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawMigration');
        };
    }


    public function getSeeds()
    {
        return function () {
            return $this->driver
                ->setPrefix($this->getCachePrefix())
                ->get('obelawSeeds');
        };
    }

    public function functionName()
    {
        return;
    }
}
