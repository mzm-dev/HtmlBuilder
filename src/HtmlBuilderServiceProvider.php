<?php

namespace Mzm\HtmlBuilder;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Mzm\HtmlBuilder\Http\Livewire\FormBuilder;
use Mzm\HtmlBuilder\Http\Livewire\FormViewer;
use Mzm\HtmlBuilder\Http\Livewire\FormList;

class HtmlBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the Livewire component
        Livewire::component('mzm-html-builder::form-builder', FormBuilder::class);
        Livewire::component('mzm-html-builder::form-viewer', FormViewer::class);
        Livewire::component('mzm-html-builder::form-list', FormList::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mzm-html-builder');

        $this->registerRoutes();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishAssets();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => 'html-builder',
            'middleware' => ['web']
        ];
    }

    protected function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/mzm-html-builder'),
        ], 'mzm-html-builder-views');
    }
}
