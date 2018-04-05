<?php

namespace Alpaca\Controllers;

use Carbon\Carbon;
use Alpaca\Models\Page;
use Alpaca\Models\User;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class StatsController extends Controller
{
    public function user()
    {
        SEO::setTitle(trans('alpaca::alpaca.stats'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $dateAfter = Carbon::now()->subMonths(6);
        $users = User::where('created_at', '>', $dateAfter)->get();

        // group
        $users = $users->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $stats = [];
        while ($dateAfter->toDateString() != Carbon::now()->toDateString()) {
            $count = 0;
            if (isset($users[$dateAfter->toDateString()])) {
                $count = $users[$dateAfter->toDateString()]->count();
            }

            $stats[$dateAfter->toDateString()] = $count;
            $dateAfter->addDay();
        }

        return view('alpaca::stats.user', compact('stats'));
    }

    public function page()
    {
        SEO::setTitle(trans('alpaca::page.page_stats'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $pages = Page::orderBy('updated_at', 'desc')->paginate(20);

        return view('alpaca::page.index', compact('pages'));
    }
}
