<?php

namespace Alcodo\Crud\Controllers;

use Alcodo\Crud\Notification\Notification;
use Alcodo\Crud\Utilities\UrlBuilder;

trait DependencyTrait
{
    /**
     * Return a notification helper class.
     *
     * @return \Alcodo\Crud\Notification\Notification
     */
    public function getNotificationClass()
    {
        return new Notification($this);
    }

    /**
     * Return a url builder helper class.
     *
     * @return \Alcodo\Crud\Utilities\UrlBuilder
     */
    public function getUrlBuilderClass($parameters = [])
    {
        return new UrlBuilder($this, $parameters);
    }
}
