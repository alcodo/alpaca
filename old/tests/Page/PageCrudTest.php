<?php

use Alpaca\Page\Controllers\PageBackend;

class PageCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new PageBackend();
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
                'text'    => 'Testpage',
                'element' => 'title',
            ],
            [
                'text'    => 'testpage',
                'element' => 'slug',
            ],
            [
                'text'    => 'Hello Laravel',
                'element' => 'body',
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
                'text'    => 'Edited page',
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
     *
     * @return array
     */
    public function getUrlParameters()
    {
        return [];
    }
}
