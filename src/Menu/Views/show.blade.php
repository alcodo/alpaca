<p>{{ $menu->title }}</p>
@if($menu->items)
    <ul>
        @foreach ($menu->items as $item)
            <li>
                {!! $item->getLink() !!}
            </li>
        @endforeach
    </ul>
@endif