<ul class="block">
    @if (Auth::check())
        <li><a href="/logout">Logout</a></li>
    @else
        <li class="{{ Request::path() === 'auth/register' ? 'active' : '' }}">
            <a href="/register">Register</a>
        </li>
        <li class="{{ Request::path() === 'auth/login' ? 'active' : '' }}">
            <a href="/login">Login</a>
        </li>
    @endif
</ul>