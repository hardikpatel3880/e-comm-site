<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="#" style="cursor: default">
            <img src="#" alt=""
                style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
            </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        @php
        $menu = json_decode(file_get_contents(resource_path('menu.json')), true);
        @endphp

        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 " style="width: 300px;">
            <form class="form-inline " onsubmit="return false;">
                <div class="input-group">
                    <input class="form-control" id="menuSearchInput" onkeyup="filterMenu()" autocomplete="off"
                        type="text" placeholder="Search for..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button" onclick="filterMenu()"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Search results dropdown -->
            <div id="searchResults" class="list-group position-absolute shadow mt-1"
                style="z-index: 1050; display: none; max-height: 300px; overflow-y: auto; width: 300px;"></div>
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- <li><a class="dropdown-item" href="#!">Logout</a></li> --}}
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                        {{-- <a class="nav-link" href="index.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a> --}}
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="{{route('product.index')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Products
                        </a>

                        <a class="nav-link" href="{{route('productSizeMaster.index')}}">
                            <div class="sb-nav-link-icon"><i class="fa fa-arrows-v" aria-hidden="true"></i></div>
                            SizeMaster
                        </a>

                        <a class="nav-link" href="{{ route('slider.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-camera" aria-hidden="true"></i></div>
                            Slider
                        </a>

                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Manage Users
                        </a>
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Manage Role
                        </a>
                        <a class="nav-link" href="{{ route('permission.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Manage Permission
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{Auth::user()->name}}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </main>
            {{-- <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        const menu = @json($menu);

    function filterMenu() {
        
        const query = document.getElementById('menuSearchInput').value.toLowerCase();
        const container = document.getElementById('searchResults');
        container.innerHTML = '';
        
        if (!query.trim()) {
            container.style.display = 'none';
            return;
        }

        let matched = 0;

        menu.forEach(group => {
            const matchedChildren = (group.children || []).filter(child =>
                child.title.toLowerCase().includes(query)
            );

            matchedChildren.forEach(child => {
                const item = document.createElement('a');
                item.href = `{{ url('/') }}/${child.route || ''}`;
                item.className = 'list-group-item list-group-item-action';
                item.textContent = child.title;
                container.appendChild(item);
                matched++;
            });
        });

        if (matched === 0) {
            const noItem = document.createElement('div');
            noItem.className = 'list-group-item text-muted';
            noItem.textContent = 'No results found.';
            container.appendChild(noItem);
        }

        container.style.display = 'block';
    }
    // Hide results on outside click
    document.addEventListener('click', function(event) {
        const input = document.getElementById('menuSearchInput');
        const results = document.getElementById('searchResults');
        if (!input.contains(event.target) && !results.contains(event.target)) {
            results.style.display = 'none';
        }
    });
</script>

    </script>
</body>

</html>