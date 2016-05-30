<?php

class AlpacaTestCase extends TestCase
{
    /**
     * SetUp before test
     */
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }
}
