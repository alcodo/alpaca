<?php

use Alpaca\Crud\Tests\CrudTestContract;
use Alpaca\Crud\Tests\CrudTestTrait;
use Alpaca\Menu\Controllers\ItemBackend;
use Alpaca\Menu\Models\Menu;

class ItemCrudTest extends AlpacaTestCase implements CrudTestContract
{
    use CrudTestTrait;

    protected $menu_id;

    public function setUp()
    {
        parent::setUp();

        // create menu
        $menu = alpacaFactory(Menu::class)->create();
        $this->menu_id = $menu;
    }

    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new ItemBackend();
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
                'text'    => 'CMF',
                'element' => 'text',
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
                'text'    => 'Larave',
                'element' => 'text',
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
        return [
            0 => $this->menu_id,
        ];
    }
}
