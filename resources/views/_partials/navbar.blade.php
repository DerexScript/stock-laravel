<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{Route::currentRouteNamed('home') ? 'active' : ''}}" aria-current="page"
                       href="{{ config('app.url') }}">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteNamed('login') ? 'active' : ''}} border border-2 border-primary rounded-3"
                           aria-current="page" href="{{ route('login') }}">Login
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link border border-2 border-success text-success rounded-3"
                           aria-current="page" href="{{ route('dashboard') }}">Dashboard
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
