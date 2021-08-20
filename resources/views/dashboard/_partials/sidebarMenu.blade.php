<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{Route::currentRouteNamed('dashboard') ? 'active' : ''}}" aria-current="page"
                   href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::currentRouteNamed('createProduct') ? 'active' : ''}}"
                   href="{{route('createProduct')}}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::currentRouteNamed('createCategory') ? 'active' : ''}}"
                   href="{{route('createCategory')}}">Category</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::currentRouteNamed('createRole') ? 'active' : ''}}"
                   href="{{route('createRole')}}">Funções</a>
            </li>
        </ul>
    </div>
</nav>
