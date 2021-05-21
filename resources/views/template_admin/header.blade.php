<nav class="navbar navbar-static-top navbar-expand-lg">
    <!-- Sidebar toggle button -->
    <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
    </button>
    <!-- search form -->
    <div class="search-form d-none d-lg-inline-block">

    </div>

    <div class="navbar-right ">
        <ul class="nav navbar-nav">
            <li class="right-sidebar-in right-sidebar-2-menu mr-3">
                <i class="mdi mdi-settings mdi-spin"></i>
            </li>
            <img src="assets/img/user/user.png" class="user-image mr-3" alt="User Image" />
            <!-- User Account -->
            {{-- @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif

            @endguest --}}
            {{-- <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
            </button> --}}
            <ul class="dropdown-menu dropdown-menu-right">
                <!-- User image -->
                <li class="dropdown-header">
                    <img src="assets/img/user/user.png" class="img-circle" alt="User Image" />
                    {{-- <div class="d-inline-block">
                        {{ Auth::user()->name }}
    </div> --}}
    </li>

    <li>
        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"><i class="mdi mdi-logout"></i>
        {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form> --}}


    </li>
    </ul>

    </ul>
    </div>
</nav>
