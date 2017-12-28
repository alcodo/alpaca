<?php

namespace Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase;

abstract class IntegrationTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->showAllRoutes();
//        dump(Application::VERSION);
    }

    protected function getPackageProviders($app)
    {
        return [
            \Alpaca\AlpacaServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->setSQLLiteDatabaseForTesting($app);
    }

    /**
     * Setup default database to use sqlite :memory:
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function setSQLLiteDatabaseForTesting($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function showAllRoutes()
    {
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $route) {

            $actionName = $route->getActionName();
            $uri = $route->uri();

            if (in_array(['GET', 'POST'], $route->methods())) {
                $url = action($actionName);
                dump('URL: ' . $url . ' URL: ' . $uri . ' Action: ' . $actionName);

            } else {
                dump('URL: ' . $uri . ' Action: ' . $actionName);
            }

        }

    }
}