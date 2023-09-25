<nav class="py-2 bg-light border-bottom float-left header-nav">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto nav-menu-list col-sm-6">
            <li class="nav-item">
                <a href="/" class="nav-link link-dark px-2 active" aria-current="page">Home</a>
            </li>
            @if(\Auth::check())
                <li class="nav-item">
                    <a href="{{ route('web.twit.index') }}" class="nav-link link-dark px-2">My Twits</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.twit.get') }}" class="nav-link link-dark px-2">Get Last 20 Twits</a>
                </li>
            @endif
        </ul>
        <ul class="nav col-sm-6">
            @if(!\Auth::check())
                <li class="nav-item">
                    <a href="{{ route('web.login.get') }}" class="nav-link link-dark px-2">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.create') }}" class="nav-link link-dark px-2">Register</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('web.show') }}" class="nav-link link-dark px-2">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.logout') }}" class="nav-link link-dark px-2">Logout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
