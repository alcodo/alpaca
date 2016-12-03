<?php

namespace Alpaca\Crud\Controllers;

use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Crud\Notification\Notification;

trait DependencyTrait
{
    /**
     * Return a notification helper class.
     *
     * @return \Alpaca\Crud\Notification\Notification
     */
    public function getNotificationClass()
    {
        return new Notification($this);
    }

    /**
     * Return a url builder helper class.
     *
     * @return \Alpaca\Crud\Utilities\UrlBuilder
     */
    public function getUrlBuilderClass($parameters = [])
    {
        return new UrlBuilder($this, $parameters);
    }
}
