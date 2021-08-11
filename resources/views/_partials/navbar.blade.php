<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ config('app.url') }}">
            <img src="{{asset('assets/img/brand/estoque.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
            {{ config('app.name') }}
        </a>
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
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{Route::currentRouteNamed('login') ? 'active' : ''}} me-1"
                           aria-current="page" href="{{ route('login') }}">Entrar
                        </a>
                    </li>
                    @if(Route::currentRouteNamed('auth.create') || Route::currentRouteNamed('login'))
                        <li class="nav-item">
                            <a class="nav-link {{Route::currentRouteNamed('auth.create') ? 'active' : ''}}"
                               aria-current="page" href="{{ route('auth.create') }}">Registrar
                            </a>
                        </li>
                    @endif
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
                            aria-labelledby="userMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <span class="d-inline-block bg-success rounded-circle" style="width: .5em; height: .5em;"></span>
                                     Dashboard
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('auth.logout')}}">
                                    <span class="d-inline-block bg-danger rounded-circle" style="width: .5em; height: .5em;"></span>
                                     Sair
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                    </svg>

                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
