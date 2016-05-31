<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-header"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img height="25" src="/assets/images/logo.png" alt="Logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Home</a></li>
{{--                <li><a class="{{ isActiveRoute('video.index') }}" href="{{ route('video.index') }}">Video</a></li>--}}
{{--                <li><a class="{{ isActiveRoute('contact.show') }}" href="{{ route('contact.show') }}">Contact</a></li>--}}
                @if (Auth::check())
                    {{--<li class="{{ strpos('/'.Request::path(), route('profile.index')) !== false ? 'active' : 'fo' }}">--}}

                    {{--<li class="{{ isActiveRoute('profile.edit.user') }}">--}}
                    {{--<a href="{{action('Auth\EditController@getEdit')}}">Profil editieren</a>--}}
                    {{--</li>--}}
                    <li><a href="/logout">Logout</a></li>
                    {{--@if (Auth::user()['role'] === 0)--}}
                    {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                    {{--aria-expanded="false">Admin <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                    {{--@include('menu.admin')--}}
                    {{--</ul>--}}
                    {{--</li>--}}
                    {{--@endif--}}
                @else
                    <li class="{{ Request::path() === 'auth/register' ? 'active' : '' }}">
                        <a href="/register">Register</a>
                    </li>
                    <li class="{{ Request::path() === 'auth/login' ? 'active' : '' }}">
                        <a href="/login">Login</a>
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
        </div>
    </div>
</nav>