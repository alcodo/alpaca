<?php

class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // alpaca
        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../src/User/Migrations'),
        ]);

        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../src/Menu/Migrations'),
        ]);
        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../src/Block/Migrations'),
        ]);
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
        // entrust config
        $entrustConfig = include __DIR__.'/../src/User/configs/entrust.php';
        $app['config']->set('entrust', $entrustConfig);

        // view
        $app['config']->set('view.paths', [__DIR__.'/view']);

        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    public function callPrivateOrProtectedMethod($obj, $name, array $args)
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }

    /**
     * @test
     */
    public function it_allows_to_use_service()
    {
        //        $this->assertNotEmpty(
//            app('Approached\LaravelImageOptimizer\ImageOptimizer')
//        );
    }
}
