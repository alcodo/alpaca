<hr/>

<h2>
    <a href="{{ $page->path }}">
        {{$page->title}}
    </a>
</h2>

{!! Alpaca\Support\Page\PageTeaser::getHtml($page) !!}

<p class="text-right">
    <a href="{{ $page->path }}" class="read-more">{{ trans('alpaca::page.readmore') }}</a>
</p>
