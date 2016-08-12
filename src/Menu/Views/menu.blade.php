<div class="block {{ $isMobileView ? 'visible-xs' : 'hidden-xs' }}">
    <p class="block-title">{{ $menu->title }}</p>
    @if($menu->items)
        <ul class="block-list {{ $menu->class }}">
            @foreach ($menu->items as $item)
                <li class="block-item {{ isActiveUrl($item->href) }}">
                    {!! $item->getLink() !!}
                </li>
            @endforeach
        </ul>
    @endif
</div>