<?php

namespace Alcodo;

use Alcodo\Crud\CrudServiceProvider;
use Alcodo\User\UserServiceProvider;
use Alcodo\Block\BlockServiceProvider;
use Alcodo\Menu\MenuServiceProvider;
use Alcodo\Page\PageServiceProvider;
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
