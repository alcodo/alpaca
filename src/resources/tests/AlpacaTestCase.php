<?php

use Illuminate\Support\Facades\Artisan;

class AlpacaTestCase extends TestCase
{
    /**
     * SetUp before test.
     */
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }
}
