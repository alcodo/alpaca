<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="is-sidebar-left mobilebutton navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="logo">
                <img src="/assets/images/logo.png" alt="Logo"/>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-header">
            <ul class="nav navbar-nav navbar-right navtop">
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
            </ul>

        </div>
    </div>
</nav>