<?php

use Alcodo\Block\Controllers\BlockBackend;
use Alcodo\Crud\Tests\CrudTestContract;
use Alcodo\Crud\Tests\CrudTestTrait;

class BlockCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alcodo\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new BlockBackend();
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
                'text'    => 'TestBlock',
                'element' => 'name',
            ],
            [
                'text'    => 'top',
                'element' => 'area',
            ],
            [
                'text'    => '2',
                'element' => 'range',
            ],
            [
                'text'    => 'Brand news in block',
                'element' => 'html',
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
                'text'    => 'Edited block',
                'element' => 'html',
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
