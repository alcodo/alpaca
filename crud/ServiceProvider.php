<?php namespace Alcodo\Crud;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // slugify
        $this->app->register(\Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider::class);
        $loader->alias('Slugify', \Cocur\Slugify\Bridge\Laravel\SlugifyFacade::class);

        // datebuilder
        $this->app->register(\Approached\LaravelDateInternational\ServiceProvider::class);
        $loader->alias('Dateintl', \Approached\LaravelDateInternational\DateIntlFacade::class);

        // formbuilder
        $this->app->register(\AdamWathan\BootForms\BootFormsServiceProvider::class);
        $loader->alias('BootForm', \AdamWathan\BootForms\Facades\BootForm::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'crud');
        $this->loadTranslationsFrom(__DIR__ . '/Langs', 'crud');
    }
}