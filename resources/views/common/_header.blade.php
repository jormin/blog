<header>
    <a href="{{ url('/') }}" class="css9a0e8a0be187f8">
        {{ config('app.name', 'Laravel') }}
    </a>

    <span class="pull-right admin-cmd-wrap">
        @if (Auth::guest())
            <a rel="nofollow" class="external beian" href="{{ url('/login') }}">
                <i class="fa fa-sign-in"></i>
            </a>
        @elseif (Auth::user()->name === 'admin')
            <a rel="nofollow" class="external beian" href="{{ route('articles.create') }}">
                <i class="fa fa-plus"></i>
            </a>
            <a rel="nofollow" class="external beian" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
    </span>
</header>