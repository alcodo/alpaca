<?php

namespace Tests\Feature\User\Helper;

use Tests\IntegrationTest;

class PermissionModuleSetAndTearUp extends IntegrationTest
{

    public function setUp()
    {
        parent::setUp();
//        $this->publishPermissionMigration();
//        $this->loadLaravelMigrations(['--database' => 'testbench']);
        $this->showAllTables();
    }

    public function tearDown()
    {
//        parent::tearDown();
//        $this->deleteMigrationFiles();
    }


    protected function publishPermissionMigration()
    {
        $this->artisan('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider',
            '--tag' => 'migrations',
        ]);
    }

}