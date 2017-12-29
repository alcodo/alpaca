<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Alpaca\Models\Page;

class PageTest extends IntegrationTest
{

    public function test_show_front_page()
    {
        $this->withoutExceptionHandling();
        $this->assertEquals(2, Page::count());
        $this->assertEquals('/hallo-welt', Page::first()->path);

        $this->get('hallo-welt')
            ->assertSuccessful()
            ->assertSee('Hallo');
    }

}