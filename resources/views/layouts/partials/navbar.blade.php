
        <header class="header d-flex" id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_toggle text-bold">
                        
                        
            </div>
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-light ">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Menu 1</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link text-bold text-primary navbar-text" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <h4>Welcome back, {{ auth()->user()->name }}</h4>
                </a>
            </li> --}}
            <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-bold text-primary navbar-text" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @can('admin')
                            <li><a class="dropdown-item" href="/dashboards" target="_blank"><i class="bi bi-layout-text-sidebar-reverse"></i>Dashboard</a></li>
                            @endcan
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form></li>
                        </ul>
                    </li>
            </ul>
        </div>
        </nav>
        </div>                    
        </header>