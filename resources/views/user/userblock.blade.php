<ul class="block-list">
    @if (Auth::check())
        <li class="block-item"><a href="/logout">Logout</a></li>
    @else
        <li class="block-item {{ Request::path() === 'auth/register' ? 'active' : '' }}">
            <a href="/register">Register</a>
        </li>
        <li class="block-item {{ Request::path() === 'auth/login' ? 'active' : '' }}">
            <a href="/login">Login</a>
        </li>
    @endif
</ul>