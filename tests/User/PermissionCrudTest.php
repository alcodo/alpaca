<?php

use Alpaca\Crud\Tests\CrudTestContract;
use Alpaca\Crud\Tests\CrudTestTrait;
use Alpaca\User\Controllers\PermissionController;

class PermissionCrudTest extends AlpacaTestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new PermissionController();
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
                'text'    => 'create-user',
                'element' => 'name',
            ],
            [
                'text'    => 'Create a user',
                'element' => 'display_name',
            ],
            [
                'text'    => 'User can create a other user',
                'element' => 'description',
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
                'text'    => 'create-user-new',
                'element' => 'name',
            ],
            [
                'text'    => 'Create new user',
                'element' => 'display_name',
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
