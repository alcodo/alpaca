<p class="nav-title">{{ $menu->title }}</p>
@if($menu->items)
    <ul class="{{ $menu->class }}">
        @foreach ($menu->items as $item)
            <li>
                {!! $item->getLink() !!}
            </li>
        @endforeach
    </ul>
@endif