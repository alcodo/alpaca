<p class="nav-title">{{ $menu->title }}</p>
@if($menu->items)
    <ul class="nav nav-pills nav-stacked {{ $menu->class }}">
        @foreach ($menu->items as $item)
            <li class="{{ isActiveUrl($item->href) }}">
                {!! $item->getLink() !!}
            </li>
        @endforeach
    </ul>
@endif