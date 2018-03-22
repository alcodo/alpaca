<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            {{ $block->title }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            @if($block->menu)
                @foreach($block->menu->links as $link)

                    @include('alpaca::menu.link.link', ['isBlockView' => false, 'link' => $link, 'class' => 'dropdown-item'])

                @endforeach
            @else
                <div class="card-body">
                    {!! $block->html !!}
                </div>
            @endif

        </div>
    </li>

</ul>