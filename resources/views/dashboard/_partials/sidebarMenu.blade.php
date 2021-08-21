<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{Route::currentRouteNamed('dashboard') ? 'active' : ''}}" aria-current="page"
                   href="{{route('dashboard')}}"><i class="bi bi-house"> Dashboard</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request()->routeIs("product.*")  ? 'active' : ''}}"
                   href="{{route('product.create')}}"><i class="bi bi-list-ul"> Produtos</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request()->routeIs("category.*") ? 'active' : ''}}"
                   href="{{route('category.create')}}"><i class="bi bi-list-ul"> Categorias De Produto</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Request()->routeIs('role.*') ? 'active' : ''}}"
                   href="{{route('role.create')}}"><i class="bi bi-list-ul"> Funções De Usuario</i></a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{Request()->routeIs('type.*') ? 'active' : ''}}"
                   href="{{route('type.create')}}"><i class="bi bi-list-ul"> Tipos de produto</i></a>
            </li>
        </ul>
    </div>
</nav>
