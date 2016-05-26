<?php

namespace Alcodo\Crud\Utilities;

use Alcodo\Crud\Controllers\CrudContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class UrlBuilder
{

    protected $controllerClassName;
    protected $parameters;

    public function __construct(CrudContract $controller, $parameters = [])
    {
        $this->controllerClassName = get_class($controller);
        $this->parameters = $parameters;
    }

    /**
     * Return index url path
     *
     * @return string
     */
    public function getUrlIndex()
    {
        return $this->getUrlByMethodName('index');
    }

    /**
     * Return create url path
     *
     * @return string
     */
    public function getUrlCreate()
    {
        return $this->getUrlByMethodName('create');
    }

    /**
     * Return create url path
     *
     * @return string
     */
    public function getUrlStore()
    {
        return $this->getUrlByMethodName('store');
    }

    /**
     * Return edit url path
     *
     * @return string
     */
    public function getUrlShow($id)
    {
        return $this->getUrlByMethodName('show', [$id]);
    }

    /**
     * Return edit url path
     *
     * @return string
     */
    public function getUrlEdit($id)
    {
        return $this->getUrlByMethodName('edit', [$id]);
    }

    /**
     * Return update url path
     *
     * @return string
     */
    public function getUrlUpdate($id)
    {
        return $this->getUrlByMethodName('update', [$id]);
    }

    /**
     * Return destroy url path
     *
     * @return string
     */
    public function getUrlDestroy($id)
    {
        return $this->getUrlByMethodName('destroy', [$id]);
    }

    /**
     * Return url by methodname
     *
     * @return string
     */
    protected function getUrlByMethodName($methodname, $methodParameters = [], $absoluteUrl = false)
    {
        $parameters = $this->addMethodParameters($methodParameters);
        return action('\\' . $this->controllerClassName . '@' . $methodname, $parameters, $absoluteUrl);
    }

    /**
     * Add url to entries
     *
     * @param Collection $entries
     * @return Collection $entries
     */
    public function setCollectionUrlReadUpdateDelete(Collection $entries)
    {
        return $entries->each(function ($item, $key) {
            $id = $item->getKey();

            $item->showUrl = $this->getUrlShow($id);
            $item->editUrl = $this->getUrlEdit($id);
            $item->destroyUrl = $this->getUrlDestroy($id);
        });
    }

    /**
     * Merge global parameter with method parameter
     *
     * @param $methodParameters
     * @return array
     */
    protected function addMethodParameters($methodParameters)
    {
        $result = $this->parameters;

        foreach ($methodParameters as $parameter) {
            array_push($result, $parameter);
        }

        return $result;
    }
}