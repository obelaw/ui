<?php

namespace Obelaw\UI\Pipeline\Identifier\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Obelaw\Facades\Bundles;
use Obelaw\UI\Pipeline\IdentifierModule;

class IdentifierMiddleware

{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $id)
    {
        $aliases = Bundles::getPluginAliases();

        if (isset($aliases[$id])) {
            $id = $aliases[$id];
        }

        $module = Bundles::getModules($id);

        $module = array_merge(['id' => $id], $module);

        View::share('_module',  $module);

        IdentifierModule::setModule($module);

        return $next($request);
    }
}
