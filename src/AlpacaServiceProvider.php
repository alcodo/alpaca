<?php

namespace Alpaca;

use Alpaca\Core\CoreServiceProvider;
use Alpaca\Crud\CrudServiceProvider;
use Alpaca\Menu\MenuServiceProvider;
use Alpaca\Page\PageServiceProvider;
use Alpaca\User\UserServiceProvider;
use Alpaca\Block\BlockServiceProvider;
use Alpaca\Email\EmailServiceProvider;
use Alpaca\Contact\ContactServiceProvider;
use Alpaca\Gallery\GalleryServiceProvider;
use Alpaca\Sitemap\SitemapServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\CookieConsent\CookieConsentServiceProvider;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        DependencyServiceProvider::class,
//        CoreServiceProvider::class,
//        CookieConsentServiceProvider::class,
        CrudServiceProvider::class,
//        UserServiceProvider::class,
//        BlockServiceProvider::class,
//        MenuServiceProvider::class,
//        SitemapServiceProvider::class,
//        ContactServiceProvider::class,
//        GalleryServiceProvider::class,
//        EmailServiceProvider::class,
        PageServiceProvider::class,
    ];
}
