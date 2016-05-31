<?php

use Alpaca\Crud\Tests\CrudTestContract;
use Alpaca\Crud\Tests\CrudTestTrait;
use Alpaca\User\Controllers\UserController;

class UserCrudTest extends AlpacaTestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new UserController();
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
                'text'    => 'John Doe',
                'element' => 'username',
            ],
            [
                'text'    => 'johndoe@example.net',
                'element' => 'email',
            ],
            [
                'text'    => 'MySecrectPassword',
                'element' => 'password',
            ],
            [
                'text'    => 'MySecrectPassword',
                'element' => 'password_confirmation',
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
                'text'    => 'John Doe Super',
                'element' => 'username',
            ],
            [
                'text'    => 'johnSUPER@example.net',
                'element' => 'email',
            ],
            [
                'text'    => 'MySecrectPassword',
                'element' => 'password',
            ],
            [
                'text'    => 'MySecrectPassword',
                'element' => 'password_confirmation',
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
