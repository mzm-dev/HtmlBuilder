<?php

namespace Mzm\HtmlBuilder;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Mzm\HtmlBuilder\Http\Livewire\FormBuilder;
use Mzm\HtmlBuilder\Http\Livewire\FormHome;
use Mzm\HtmlBuilder\Http\Livewire\FormList;
use Mzm\HtmlBuilder\Http\Livewire\FormResponse;
use Mzm\HtmlBuilder\Http\Livewire\FormSubmit;

class HtmlBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the Livewire component
        Livewire::component('mzm-html-builder::form-builder', FormBuilder::class);
        Livewire::component('mzm-html-builder::form-home', FormHome::class);
        Livewire::component('mzm-html-builder::form-list', FormList::class);
        Livewire::component('mzm-html-builder::form-response', FormResponse::class);
        Livewire::component('mzm-html-builder::form-submit', FormSubmit::class);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mzm-html-builder');

        $this->registerRoutes();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
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
}
