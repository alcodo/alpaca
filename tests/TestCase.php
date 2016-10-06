<?php

use Illuminate\Foundation\Application;

class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->setMigrations();
        $this->setFactory();

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
        // entrust config
        $entrustConfig = include __DIR__.'/../src/User/Configs/entrust.php';
        $app['config']->set('entrust', $entrustConfig);

        // alpaca settings
        $app['config']->set('page.categoryPrefix', 'category');
        $app['config']->set('contact.prefix', 'contact');
        $app['config']->set('app.key', 'ajZXLeowC4qPPajBzykbTVmwwrJOCN2d');
        $app['config']->set('mail.from',
            ['address' => 'info@example.com', 'name' => 'Contact Example']
            );
        // 5.1
        $app['config']->set('auth.model', Alpaca\User\Models\User::class);
        // 5.2
        $app['config']->set('auth.providers.users.model', Alpaca\User\Models\User::class);

        // view
//        $viewFolder = __DIR__.'/../src/resources/views';
        $viewFolder = __DIR__.'/TestHelper/view';
        $app['config']->set('view.paths', [$viewFolder]);

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

    protected function setMigrations()
    {
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
            '--realpath' => realpath(__DIR__.'/../src/Page/Migrations'),
        ]);
        $this->artisan('migrate', [
            '--database' => 'testing',
            '--realpath' => realpath(__DIR__.'/../src/Block/Migrations'),
        ]);
    }

    protected function setFactory()
    {
        $path = __DIR__.'/../resources/factories/';
        $this->withFactories($path);
    }
}
