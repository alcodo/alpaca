<?php

namespace Alcodo;

use Alcodo\Block\BlockServiceProvider;
use Alcodo\Crud\CrudServiceProvider;
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
        DependencyServiceProvider::class,
        CrudServiceProvider::class,
        UserServiceProvider::class,
        BlockServiceProvider::class,
        PageServiceProvider::class
    ];
}
