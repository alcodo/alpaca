<?php

namespace Alpaca\Crud\Tests;

interface CrudTestContract
{
    /**
     * Return the controller class for the crud test.
     *
     * @return \Alpaca\Crud\Controllers\CrudContract
     */
    public function getControllerClass();

    /**
     * Creates the form with this values.
     *
     * @return array
     */
    public function getCreateFormValues();

    /**
     * Edit the form with this values.
     *
     * @return array
     */
    public function getEditFormValues();

    /**
     * Get the create button text to press form.
     *
     * @return string
     */
    public function getCreateButtonText();

    /**
     * Get the edit button text to press form.
     *
     * @return string
     */
    public function getEditButtonText();

    /**
     * Get additional parameters for testing.
     *
     * @return array
     */
    public function getUrlParameters();

    /**
     * @test
     */
    public function it_allows_see_index_page();

    /**
     * @test
     */
    public function it_allows_create_entry();

    /**
     * @test
     */
    public function it_allows_edit_entry();

    /**
     * @test
     */
    public function it_allows_destroy_entry();
}
