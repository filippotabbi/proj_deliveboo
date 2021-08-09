<nav class="navbar fixed-top navbar-expand-md" id="nav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}"> <img class="logo-navbar"
                src="/images/logos/deliveboo-2.png" alt=""> </a>
        <button class="navbar-toggler" v-on:click="showNavToggler()">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" :class="(showNav == true) ? 'show' : '' ">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.restaurants.index') }}">I miei ristoranti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.index') }}">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>
