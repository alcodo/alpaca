<div class="sidebar sidebar-left">

    <div class="sidebar-header">
        <button type="button" class="sidebar-close"><span>×</span></button>
        <p class="sidebar-title">Navigation</p>
    </div>

    <ul class="nav navbar-nav">

        <li><a href="/">Startseite</a></li>
        <li class="{{ isActiveUrl('/info') }}">
            <a href="/info">Info</a>
        </li>
        @if (Auth::guest())
            <li class="{{ isActiveUrl('/login') }}">
                <a href="{{ url('/login') }}">Login</a>
            </li>
            <li class="{{ isActiveUrl('/register') }}">
                <a href="{{ url('/register') }}">{{ trans('user::user.register') }}</a>
            </li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->username }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif

        @if(Auth::user() && Auth::user()->hasRole('admin'))
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Admin <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    @if(view()->exists('page::cmf.menu'))
                        @include('page::cmf.menu')
                    @endif
                    @if(view()->exists('gallery::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('gallery::cmf.menu')
                    @endif
                    @if(view()->exists('user::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('user::cmf.menu')
                    @endif
                    @if(view()->exists('video::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('video::cmf.menu')
                    @endif
                    @if(view()->exists('block::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('block::cmf.menu')
                    @endif
                    @if(view()->exists('menu::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('menu::cmf.menu')
                    @endif
                    @if(view()->exists('forum::cmf.menu'))
                        <li role="separator" class="divider"></li>
                        @include('forum::cmf.menu')
                    @endif
                </ul>
            </li>
        @endif
    </ul>

    {!! BlockMobile::getMobileBlocks() !!}
</div>