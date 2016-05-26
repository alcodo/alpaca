<?php

namespace Alcodo\Crud\Controllers;


trait TextTrait
{

    public function getTitle()
    {
        return $this->getPluralModelName();
    }

    public function getDescription()
    {
        return trans('crud::crud.administration_type', ['type' => $this->getPluralModelName()]);
    }

    public function getUrlCreateText()
    {
        return trans('crud::crud.create_type', ['type' => $this->getSingularModelName()]);
    }

    public function getUrlEditText()
    {
        return trans('crud::crud.edit_type', ['type' => $this->getSingularModelName()]);
    }

}