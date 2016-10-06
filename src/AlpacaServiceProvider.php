<?php

namespace Alpaca;

use Alpaca\Contact\ContactServiceProvider;
use Alpaca\Core\CoreServiceProvider;
use Alpaca\Crud\CrudServiceProvider;
use Alpaca\Gallery\GalleryServiceProvider;
use Alpaca\Sitemap\SitemapServiceProvider;
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
    protected $providers = array(
        DependencyServiceProvider::class,
        CoreServiceProvider::class,
        CrudServiceProvider::class,
        UserServiceProvider::class,
        BlockServiceProvider::class,
        MenuServiceProvider::class,
        SitemapServiceProvider::class,
        ContactServiceProvider::class,
        GalleryServiceProvider::class,
        PageServiceProvider::class,
    );
}
