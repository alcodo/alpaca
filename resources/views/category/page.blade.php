<hr/>

<h2>
    <a href="{{ $page->path }}">
        {{$page->title}}
    </a>
</h2>

{!!  $page->teaser !!}

<p class="text-right">
    <a href="{{ $page->path }}" class="read-more">{{ trans('alpaca::page.readmore') }}</a>
</p>

{{--@if(strpos($page->body, Alpaca\Page\Models\alpaca::BREAK_TAG) !== false)--}}
    {{--tag exists--}}

    {{--{!!  strstr($page->body, Alpaca\Page\Models\alpaca::BREAK_TAG, true) !!}--}}
    {{--<p class="text-right">--}}

        {{--<a href="{{ $page->getPageLink() }}" class="read-more">{{ trans('alpaca::page.readmore') }}</a>--}}
    {{--</p>--}}

{{--@else--}}
    {{--output basic--}}
    {{--{!!  $page->body !!}--}}
{{--@endif--}}
