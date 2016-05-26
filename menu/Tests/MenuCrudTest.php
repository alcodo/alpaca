<?php

use Alcodo\Crud\Tests\CrudTestContract;
use Alcodo\Crud\Tests\CrudTestTrait;
use Alcodo\Menu\Controllers\MenuBackend;


class MenuCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test
     *
     * @return \Alcodo\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new MenuBackend();
    }

    /**
     * Creates the form with this values
     *
     * @return array
     */
    public function getCreateFormValues()
    {
        return array(
            [
                'text' => 'Navigation',
                'element' => 'title'
            ],
            [
                'text' => 'navi-top',
                'element' => 'class'
            ]
        );
    }

    /**
     * Edit the form with this values
     *
     * @return array
     */
    public function getEditFormValues()
    {
        return array(
            [
                'text' => 'Usermenu',
                'element' => 'title'
            ],
        );
    }

    /**
     * Get the create button text to press form
     *
     * @return string
     */
    public function getCreateButtonText()
    {
        return trans('crud::crud.save');
    }

    /**
     * Get the edit button text to press form
     *
     * @return string
     */
    public function getEditButtonText()
    {
        return trans('crud::crud.save');
    }

    /**
     * Get additional parameters for testing
     * @return array
     */
    public function getUrlParameters()
    {
        return [];
    }
}
