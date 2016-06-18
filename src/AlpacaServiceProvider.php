<?php

namespace Alpaca;

use Alpaca\Crud\CrudServiceProvider;
use Alpaca\User\UserServiceProvider;
use Alpaca\Block\BlockServiceProvider;
use Alpaca\Menu\MenuServiceProvider;
use Alpaca\Page\PageServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        DependencyServiceProvider::class,
        CrudServiceProvider::class,
        UserServiceProvider::class,
        BlockServiceProvider::class,
        MenuServiceProvider::class,
        PageServiceProvider::class,
    ];
}
