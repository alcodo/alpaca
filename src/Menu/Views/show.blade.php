<p class="block-title">{{ $menu->title }}</p>
@if($menu->items)
    <ul class="block {{ $menu->class }}">
        @foreach ($menu->items as $item)
            <li class="{{ isActiveUrl($item->href) }}">
                {!! $item->getLink() !!}
            </li>
        @endforeach
    </ul>
@endif