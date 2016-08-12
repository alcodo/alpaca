<ul class="nav navbar-nav {{ $menu->class }}">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" id="drop-menu-{{$menu->id}}" data-toggle="dropdown" role="button"
           aria-haspopup="true" aria-expanded="false">
            {{ $menu->title }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="drop-menu-{{$menu->id}}">
            @foreach ($menu->items as $item)
                <li class="{{ isActiveUrl($item->href) }}">
                    {!! $item->getLink() !!}
                </li>
            @endforeach
        </ul>
    </li>
</ul>