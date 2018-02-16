<?php

namespace Tests;

use Alpaca\Models\User;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

abstract class IntegrationTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->artisan('migrate');
        $this->loadRoutesAgain();
//        $this->showAllRoutes();
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
        $this->setCipherKey($app);
        $this->setSQLLiteDatabaseForTesting($app);
    }

    /**
     * Setup default database to use sqlite :memory:.
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
        $app['config']->set('auth.providers', [
            'users' => [
                'driver' => 'eloquent',
                'model' => \Alpaca\Models\User::class,
            ],
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
                dump('URL: '.$url.' URL: '.$uri.' Action: '.$actionName);
            } else {
                dump('URL: '.$uri.' Action: '.$actionName);
            }
        }
    }

    protected function showAllTables()
    {
        $tables = DB::select('SELECT name FROM sqlite_master  WHERE type=\'table\''); // for mysql use 'SHOW TABLES'

        foreach ($tables as $table) {
            foreach ($table as $key => $value) {
                dump($value);
            }
        }
    }

    protected function setCipherKey($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
    }

    protected function loadRoutesAgain()
    {
        include __DIR__.'/../src/routes_fronted.php';
    }

    protected function deleteMigrationFiles()
    {
        $path = base_path('database/migrations');
        $files = glob($path.'/*.php'); // get all file names

        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file);
            } // delete file
        }
    }

    protected function loginAsAdmin()
    {
        $this->actingAs(User::first());
    }

    protected function makeAuth()
    {
        // create directories
        $controllersPath = base_path('app/Http/Controllers');
        if (! file_exists($controllersPath)) {
            mkdir($controllersPath, 0777, true);
        }

        $routesPath = base_path('routes');
        if (! file_exists($routesPath)) {
            mkdir($routesPath, 0777, true);
        }

        // execute command
        $this->artisan('make:auth', [
            '--force' => '--force',
        ]);
    }
}
