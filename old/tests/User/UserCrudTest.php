<?php

use Alpaca\User\Controllers\UserBackend;

class UserCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new UserBackend();
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