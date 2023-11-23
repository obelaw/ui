<?php

namespace Obelaw\UI;

use Illuminate\Support\ServiceProvider;
use Obelaw\UI\Views\Layout\DashboardLayout;

class ObelawUIServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewComponentsAs('obelaw', $this->viewComponents());

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'obelaw-ui');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/obelaw-ui'),
            ]);

            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('vendor/obelaw'),
            ], 'obelaw-ui:assets');
        }
    }

    private function viewComponents(): array
    {
        return [
            DashboardLayout::class,
        ];
    }
}
