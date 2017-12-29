<?php

namespace Alpaca\Crud\Controllers;

trait ViewTrait
{
    /**
     * @return string
     */
    public function getViewIndex()
    {
        return 'crud::list';
    }

    /**
     * @return string
     */
    public function getViewShow()
    {
        return 'crud::show';
    }

    /**
     * @return string
     */
    public function getViewCreate()
    {
        return 'crud::form';
    }

    /**
     * @return string
     */
    public function getViewEdit()
    {
        return $this->getViewCreate();
    }

    /**
     * Return a array with form sizes.
     *
     * @return array
     */
    public function getColumnSizes()
    {
        return [
            'sm' => [4, 8],
            'lg' => [3, 9],
        ];
    }
}
