<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Alpaca\Models\Redirect;
use Illuminate\Support\Facades\Event;
use Alpaca\Repositories\RedirectRepository;
use Alpaca\Events\Redirect\RedirectWasCreated;
use Alpaca\Events\Redirect\RedirectWasDeleted;
use Alpaca\Events\Redirect\RedirectWasUpdated;

class RedirectTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_index_redirect()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/redirect')
            ->assertSuccessful()
            ->assertSee('Create redirect');
    }

    public function test_store_redirect()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/redirect', [
            'from' => '/hallo',
            'to' => '/welt',
            'code' => 301,
        ])
            ->assertRedirect('/backend/redirect');

        $this->assertDatabaseHas('redirects', [
            'from' => '/hallo',
        ]);

        Event::assertDispatched(RedirectWasCreated::class);
    }

    public function test_update_redirect()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createRedirect();

        $this->put('/backend/redirect/1', [
            'from' => '/symfony',
            'to' => '/laravel',
            'code' => 301,
        ])
            ->assertRedirect('/backend/redirect');

        $this->assertDatabaseHas('redirects', [
            'to' => '/laravel',
        ]);

        Event::assertDispatched(RedirectWasUpdated::class);
    }

    public function test_destroy_redirect()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createRedirect();
        $this->assertEquals(1, Redirect::count());

        $this->delete('/backend/redirect/1')
            ->assertRedirect('/backend/redirect');

        $this->assertEquals(0, Redirect::count());

        Event::assertDispatched(RedirectWasDeleted::class);
    }

    public function test_show_redirect()
    {
        $this->get('/foo')
            ->assertStatus(404);

        $this->createRedirect();

        // bootstrap the laravel routes new
        parent::setUp();

        $this->get('/foo')
            ->assertStatus(302)
            ->assertRedirect('/bla');

        $this->assertEquals(1, Redirect::first()->hits);
    }

    private function createRedirect()
    {
        $repo = new RedirectRepository();
        $repo->create([
            'from' => '/foo',
            'to' => '/bla',
            'code' => 302,
        ]);
    }
}
