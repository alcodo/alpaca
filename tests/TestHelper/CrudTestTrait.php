<?php

use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;

trait CrudTestTrait
{
    /**
     * @test
     */
    public function it_allows_see_index_page()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $controller = $this->getControllerClass();

        // get index url
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());
        $url = $urlBuilder->getUrlIndex();

        // check
        $this->visit($url)
            ->see($controller->getPluralModelName());
    }

    /**
     * @test
     */
    public function it_allows_create_entry()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $controller = $this->getControllerClass();

        // get create url
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());
        $url = $urlBuilder->getUrlCreate();

        // call
        $this->visit($url);

        // fill the form
        foreach ($this->getCreateFormValues() as $values) {
            $this->type($values['text'], $values['element']);
        }

        // check
        $this->press($this->getCreateButtonText())
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_allows_edit_entry()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $controller = $this->getControllerClass();

        // create entry
        $this->it_allows_create_entry();
        $model = $controller->getModelClass();
        $entry = $model::first();

        // get create url
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());
        $url = $urlBuilder->getUrlEdit($entry->getKey());

        // call
        $this->visit($url);

        // fill the form
        foreach ($this->getEditFormValues() as $values) {
            $this->type($values['text'], $values['element']);
        }

        // check
        $this->press($this->getEditButtonText())
            ->see('alert-success');
    }

    /**
     * @test
     */
    public function it_allows_destroy_entry()
    {
        $adminUser = User::first();
        $this->actingAs($adminUser);

        $this->it_allows_create_entry();

        // get index url
        /** @var CrudContract $controller */
        $controller = $this->getControllerClass();
        $urlBuilder = new UrlBuilder($controller, $this->getUrlParameters());

        /** @var Model $model */
        $model = $controller->getModelClass();

        // get last item
        $emptyModel = new $model();
        $columnId = $emptyModel->getKeyName();

        $lastEntry = $model::orderBy($columnId, 'desc')->first();
        $url = $urlBuilder->getUrlDestroy($lastEntry->getKey());


        // check
        $this->delete($url, ['_token' => csrf_token()])
            ->see('Redirecting');
    }
}
