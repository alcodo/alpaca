<ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown @if(Block::isMenuActive($block)) show @endif">
        <a id="block{{ $block->id }}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            {{ $block->title }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu @if(Block::isMenuActive($block)) show @endif" aria-labelledby="block{{ $block->id }}">

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