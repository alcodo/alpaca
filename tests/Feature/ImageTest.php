<?php

namespace Tests\Feature;

use Alpaca\Events\Image\ImageWasCreated;
use Alpaca\Events\Image\ImageWasDeleted;
use Alpaca\Events\Image\ImageWasUpdated;
use Alpaca\Repositories\BlockRepository;
use Alpaca\Repositories\ImageRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class ImageTest extends IntegrationTest
{

    public function test_index_image()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/image')
            ->assertSuccessful()
            ->assertSee('Add image');
    }

    public function test_store_image()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/image', [
            'filepath' => '/images/test.jpg',
        ])
            ->assertRedirect('/backend/image');

        $this->assertDatabaseHas('al_images', [
            'filepath' => '/images/test.jpg',
        ]);

        Event::assertDispatched(ImageWasCreated::class);
    }

    public function test_update_image()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createImage();

        $this->put('/backend/image/1', [
            'filepath' => 'foo.png',
        ])
            ->assertRedirect('/backend/image');

        $this->assertDatabaseHas('al_images', [
            'filepath' => 'foo.png',
        ]);

        Event::assertDispatched(ImageWasUpdated::class);
    }

    public function test_destroy_image()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createImage();

        $this->assertDatabaseHas('al_images', [
            'filepath' => 'test.jpg',
        ]);

        $this->delete('/backend/image/1')
            ->assertRedirect('/backend/image');

        $this->assertDatabaseMissing('al_images', [
            'filepath' => 'test.jpg',
        ]);

        Event::assertDispatched(ImageWasDeleted::class);
    }

    private function createImage()
    {
        $repo = new ImageRepository();
        $repo->create([
            'filepath' => 'test.jpg',
        ]);
    }

}