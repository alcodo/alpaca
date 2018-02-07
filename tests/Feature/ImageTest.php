<?php

namespace Tests\Feature;

use Alpaca\Events\Image\ImageWasCreated;
use Alpaca\Events\Image\ImageWasDeleted;
use Alpaca\Events\Image\ImageWasUpdated;
use Alpaca\Models\Image;
use Alpaca\Repositories\ImageRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\IntegrationTest;

class ImageTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_index_image()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/image')
            ->assertSuccessful()
            ->assertSee('Add image');
    }

    public function test_store_image()
    {
        Storage::fake('public');
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/image', [
            'title' => 'Example image',
            'file' => UploadedFile::fake()->image('example.jpg'),
        ])
            ->assertRedirect('/backend/image');


        $this->assertDatabaseHas('images', [
            'title' => 'Example image',
        ]);
        Storage::disk('public')->assertExists(Image::first()->filepath);

        Event::assertDispatched(ImageWasCreated::class);
    }

    public function test_update_image()
    {
        Storage::fake('public');
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createImage();
        $filepathBefore = Image::first()->filepath;
        Storage::disk('public')->assertExists($filepathBefore);

        $this->put('/backend/image/1', [
            'title' => 'Updated title',
            'file' => UploadedFile::fake()->image('updated.gif'),
        ])
            ->assertRedirect('/backend/image');

        $this->assertDatabaseHas('images', [
            'title' => 'Updated title',
        ]);
        $filepathAfter = Image::first()->filepath;
        Storage::disk('public')->assertExists($filepathAfter);
        $this->assertNotEquals($filepathBefore, $filepathAfter);

        Event::assertDispatched(ImageWasUpdated::class);
    }

    public function test_destroy_image()
    {
        Storage::fake('public');
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createImage();
        $filepath = Image::first()->filepath;
        Storage::disk('public')->assertExists($filepath);

        $this->assertDatabaseHas('images', [
            'filepath' => $filepath,
        ]);

        $this->delete('/backend/image/1')
            ->assertRedirect('/backend/image');

        $this->assertDatabaseMissing('images', [
            'filepath' => 'test.jpg',
        ]);
        Storage::disk('public')->assertMissing($filepath);

        Event::assertDispatched(ImageWasDeleted::class);
    }

    private function createImage()
    {
        $repo = new ImageRepository();
        $repo->create([
            'title' => 'Test',
            'file' => UploadedFile::fake()->image('test.png'),
        ]);
    }

}