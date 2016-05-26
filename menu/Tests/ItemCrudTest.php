<?php

use Alcodo\Crud\Tests\CrudTestContract;
use Alcodo\Crud\Tests\CrudTestTrait;
use Alcodo\Menu\Controllers\ItemBackend;
use Alcodo\Menu\Models\Menu;

class ItemCrudTest extends TestCase implements CrudTestContract
{
    use CrudTestTrait;

    protected $menu_id;

    public function setUp()
    {
        parent::setUp();

        // create menu
        $menu = factory(Menu::class)->create();
        $this->menu_id = $menu;
    }

    /**
     * Return the controller class for the crud test
     *
     * @return \Alcodo\Crud\Controllers\CrudContract
     */
    public function getControllerClass()
    {
        return new ItemBackend();
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
                'text' => 'CMF',
                'element' => 'text'
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
                'text' => 'Larave',
                'element' => 'text'
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
        return [
            0 => $this->menu_id
        ];
    }
}
