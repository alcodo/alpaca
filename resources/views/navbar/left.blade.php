<ul class="navbar-nav mr-auto">
    <li class="nav-item {{ isActiveUrlExact('/') }}">
        <a class="nav-link" href="/">Home</a>
    </li>
    <li class="nav-item {{ isActiveUrl('/about-us') }}">
        <a class="nav-link" href="/about-us">About us</a>

        {{--Block for mobile view--}}
        @if(isActiveUrl('/about-us') && !empty(Block::getMobileMenuBlocks()))
            <div class="d-sm-block d-md-none" style="font-size: 90%;background-color: #e6e6e6;padding: 10px;">
                {!! Block::getMobileMenuBlocks() !!}
            </div>
        @endif
    </li>
</ul>