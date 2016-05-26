<?php

namespace Alcodo;

use Alcodo\Page\PageServiceProvider;
use Alcodo\User\UserServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
//        UserServiceProvider::class,
//        PageServiceProvider::class
    ];
}
