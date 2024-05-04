<?php

namespace Obelaw\UI;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Obelaw\Facades\Bundles;
use Obelaw\Render\BundlesScaneers;
use Obelaw\Schema\Scaneer\Scaneer;
use Obelaw\UI\Compiles\Scan\Appends\NavbarAppendsCompile;
use Obelaw\UI\Compiles\Scan\Appends\ViewsAppendsCompile;
use Obelaw\UI\Compiles\Scan\Modules\FormsCompile;
use Obelaw\UI\Compiles\Scan\Modules\GridsCompile;
use Obelaw\UI\Compiles\Scan\Modules\InfoCompile;
use Obelaw\UI\Compiles\Scan\Modules\MigrationsCompile;
use Obelaw\UI\Compiles\Scan\Modules\NavbarCompile;
use Obelaw\UI\Compiles\Scan\Modules\RoutesApiCompile;
use Obelaw\UI\Compiles\Scan\Modules\RoutesDashboardCompile;
use Obelaw\UI\Compiles\Scan\Modules\SeedsCompile;
use Obelaw\UI\Compiles\Scan\Modules\ViewsCompile;
use Obelaw\UI\Compiles\Scan\Modules\WidgetsCompile;
use Obelaw\UI\Compiles\Scan\Plugins\FormsPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\GridsPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\MigrationsPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\NavbarPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\RoutesApiPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\RoutesDashboardPluginCompile;
use Obelaw\UI\Compiles\Scan\Plugins\ViewsPluginCompile;
use Obelaw\UI\Components\Fields\CheckboxField;
use Obelaw\UI\Components\Fields\DateField;
use Obelaw\UI\Components\Fields\SelectField;
use Obelaw\UI\Components\Fields\TextareaField;
use Obelaw\UI\Components\Fields\TextField;
use Obelaw\UI\Components\FormComponent;
use Obelaw\UI\Components\Groups\LargeGroup;
use Obelaw\UI\Components\Groups\SmallGroup;
use Obelaw\UI\Components\MenuComponent;
use Obelaw\UI\Components\Reporting\ChartComponent;
use Obelaw\UI\Mixin\BundlesMixin;
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
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ui.php',
            'obelaw.ui'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // Livewire::component('obelaw-tool-reporting-chart', ChartComponent::class);

        $router->aliasMiddleware('obelawIdentifier', IdentifierMiddleware::class);

        $this->loadViewComponentsAs('obelaw', $this->viewComponents());

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'obelaw-ui');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ui.php' => config_path('obelaw/ui.php'),
            ]);

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/obelaw-ui'),
            ], ['obelaw:ui', 'obelaw:ui:views']);

            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('vendor/obelaw'),
            ], ['obelaw:ui', 'obelaw:ui:assets']);
        }

        BundlesScaneers::mergeModuleScaneers(function (Scaneer $scaneers) {
            $scaneers->add(NavbarCompile::class);
            $scaneers->add(RoutesDashboardCompile::class);
            $scaneers->add(RoutesApiCompile::class);
            $scaneers->add(FormsCompile::class);
            $scaneers->add(GridsCompile::class);
            $scaneers->add(ViewsCompile::class);
            $scaneers->add(WidgetsCompile::class);
            $scaneers->add(MigrationsCompile::class);
            $scaneers->add(SeedsCompile::class);
        });

        BundlesScaneers::mergePluginScaneers(function (Scaneer $scaneers) {
            $scaneers->add(NavbarPluginCompile::class);
            $scaneers->add(RoutesDashboardPluginCompile::class);
            $scaneers->add(RoutesApiPluginCompile::class);
            $scaneers->add(FormsPluginCompile::class);
            $scaneers->add(GridsPluginCompile::class);
            $scaneers->add(ViewsPluginCompile::class);
            $scaneers->add(MigrationsPluginCompile::class);
        });

        BundlesScaneers::mergeAppendScaneers(function (Scaneer $scaneers) {
            $scaneers->add(NavbarAppendsCompile::class);
            $scaneers->add(ViewsAppendsCompile::class);
        });

        Bundles::mixin(new BundlesMixin());
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

            LargeGroup::class,
            SmallGroup::class,

            ChartComponent::class,
        ];
    }
}
