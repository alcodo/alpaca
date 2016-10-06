<?php

use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Gallery\Controllers\GalleryBackend;
use Alpaca\User\Models\User;

class GalleryCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    public $jpgFilepath;
    public $pngFilepath;
    public $gifFilepath;

    public function setUp()
    {
        parent::setUp();

        $this->jpgFilepath = __DIR__.'/images/test.jpg';
        $this->pngFilepath = __DIR__.'/images/test.png';
        $this->gifFilepath = __DIR__.'/images/test.gif';
    }

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new GalleryBackend();
    }

    /**
     * Creates the form with this values.
     *
     * @return array
     */
    public function getCreateFormValues()
    {
        return [
            [
                'text' => $this->jpgFilepath,
                'element' => 'file',
            ],
        ];
    }

    /**
     * Edit the form with this values.
     *
     * @return array
     */
    public function getEditFormValues()
    {
        return [
            [
                'text' => 'Best picture',
                'element' => 'title',
            ],
        ];
    }

    /**
     * Get the create button text to press form.
     *
     * @return string
     */
    public function getCreateButtonText()
    {
        return trans('crud::crud.save');
    }

    /**
     * Get the edit button text to press form.
     *
     * @return string
     */
    public function getEditButtonText()
    {
        return trans('crud::crud.save');
    }

    /**
     * Get additional parameters for testing.
     * @return array
     */
    public function getUrlParameters()
    {
        return [];
    }

    /**
     * @test
     */
    public function it_allows_create_entry_with_png_file()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $controller = $this->getControllerClass();

        // get create url
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());
        $url = $urlBuilder->getUrlCreate();

        // call
        $this->visit($url);

        // fill the form
        $this->type($this->pngFilepath, 'file');

        // check
        $this->press($this->getCreateButtonText())
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_allows_create_entry_with_gif_file()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $controller = $this->getControllerClass();

        // get create url
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());
        $url = $urlBuilder->getUrlCreate();

        // call
        $this->visit($url);

        // fill the form
        $this->type($this->gifFilepath, 'file');

        // check
        $this->press($this->getCreateButtonText())
            ->see('alert-success');
    }
}
