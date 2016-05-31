<?php

use Alcodo\Crud\Tests\CrudTestContract;
use Alcodo\Crud\Tests\CrudTestTrait;
use Alcodo\Page\Controllers\PageBackend;

class CategoryCrudTest extends AlpacaTestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alcodo\Crud\Controllers\CrudContract
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
                'text'    => 'General',
                'element' => 'title',
            ],
            [
                'text'    => 'genral',
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
                'text'    => 'Laravel',
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
