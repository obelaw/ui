<?php

namespace Obelaw\UI;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Obelaw\UI\Components\Fields\CheckboxField;
use Obelaw\UI\Components\Fields\DateField;
use Obelaw\UI\Components\Fields\SelectField;
use Obelaw\UI\Components\Fields\TextareaField;
use Obelaw\UI\Components\Fields\TextField;
use Obelaw\UI\Components\FormComponent;
use Obelaw\UI\Components\MenuComponent;
use Obelaw\UI\Pipeline\Identifier\Http\Middleware\IdentifierMiddleware;
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
    public function boot(Router $router)
    {
        $router->aliasMiddleware('obelawIdentifier', IdentifierMiddleware::class);

        $this->loadViewComponentsAs('obelaw', $this->viewComponents());

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'obelaw-ui');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/obelaw-ui'),
            ], ['obelaw:ui', 'obelaw:ui:views']);

            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('vendor/obelaw'),
            ], ['obelaw:ui', 'obelaw:ui:assets']);
        }
    }

    private function viewComponents(): array
    {
        return [
            DashboardLayout::class,

            MenuComponent::class,

            // Form
            FormComponent::class,
            // Fields
            TextField::class,
            SelectField::class,
            TextareaField::class,
            DateField::class,
            CheckboxField::class,
        ];
    }
}
