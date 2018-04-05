<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Alpaca\Mail\ContactFormWasFilled;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Config;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Alpaca\Models\Page;
use Alpaca\Models\User;
use Carbon\Carbon;

class StatsController extends Controller
{

    public function user()
    {
        // seo
        SEO::setTitle(trans('alpaca::user.registrated_user') . ' - ' . trans('alpaca::alpaca.stats'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        // parameter
        $view = 'month';
        $format = 'Y-m';
        $last = 6;
        if (request()->has('view') && ! empty(request()->get('view'))) {
            $view = request()->get('view');
        }
        if (request()->has('last') && ! empty(request()->get('last'))) {
            $last = request()->get('last');
        }
        if ($view == 'day') {
            $format = 'Y-m-d';
        }

        // get date
        $dateAfter = Carbon::now()->subMonths($last);
        if ($view === 'month') {
            $dateAfter->startOfMonth();
        } elseif ($view === 'day') {
            $dateAfter->startOfDay();
        }

        $users = User::where('verified', true)->where('created_at', '>', $dateAfter)->get();

        // stats
        $sum = $users->count();
        $daysBetween = $dateAfter->diffInDays(Carbon::now());
        $avg = round($sum / $daysBetween, 2);

        // group
        $users = $users->groupBy(function ($item) use ($format) {
            return $item->created_at->format($format);
        });

        $stats = [];
        while ($dateAfter->toDateString() < Carbon::now()->toDateString()) {

            $count = 0;
            if (isset($users[$dateAfter->format($format)])) {
                $count = $users[$dateAfter->format($format)]->count();
            }

            $stats[$dateAfter->format($format)] = $count;

            if ($view === 'month') {
                $dateAfter->addMonth();
            } else {
                $dateAfter->addDay();
            }
        }

        // parse
//        if ($view === 'month') {
//
//            // group
//            $users = $users->groupBy(function ($item) {
//                return $item->created_at->format('Y-m');
//            });
//
//            $stats = [];
//            while ($dateAfter->toDateString() < Carbon::now()->toDateString()) {
//
//                $count = 0;
//                if (isset($users[$dateAfter->format('Y-m')])) {
//                    $count = $users[$dateAfter->format('Y-m')]->count();
//                }
//
//                $stats[$dateAfter->format('Y-m')] = $count;
//
//                    if ($view === 'month') {
//                $dateAfter->addMonth();
//                } else {
//                    $dateAfter->addDay();
//                }
//            }
//
////            dd($stats);
//
//        } elseif ($view === 'day') {
//
//            // group
//            $users = $users->groupBy(function ($item) {
//                return $item->created_at->format('Y-m-d');
//            });
//
//            $stats = [];
//            while ($dateAfter->toDateString() != Carbon::now()->toDateString()) {
//
//                $count = 0;
//                if (isset($users[$dateAfter->toDateString()])) {
//                    $count = $users[$dateAfter->toDateString()]->count();
//                }
//
//                $stats[$dateAfter->toDateString()] = $count;
//                $dateAfter->addDay();
//            }
//
//        }

        // stats
        $min = $users->min()->count();
        $max = $users->max()->count();

        return view('alpaca::stats.user', compact('stats', 'sum', 'avg', 'min', 'max'));
    }

    public function page()
    {
        SEO::setTitle(trans('alpaca::page.page_stats'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $pages = Page::orderBy('updated_at', 'desc')->paginate(20);

        return view('alpaca::page.index', compact('pages'));
    }

}
