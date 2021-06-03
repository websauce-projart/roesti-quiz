@if (Auth::check())
    You are logged. <a href="{{ url('logout') }}">Logout</a>
@endif