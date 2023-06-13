{{-- <header class="navbar navbar-primary sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 bg-primary text-white font-bold bg-dark" href="#">Alwindi</a>
        <button class="navbar-toggler d-md-none collapsed bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-warning"></span>
        </button>
        <div class="navbar-nav bg-dark">
            <div class="nav-item text-nowrap bg-dark">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link px-3 bg-dark text-white border-0">
                Logout <span data-feather="log-out"></span></button>
            </form>
            </div>
        </div>
</header> --}}
            <ul class="nav-links">
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link px-3 bg-dark text-white border-0">
                        Logout <span data-feather="log-out"></span></button>
                    </form>
                </li>
            </ul>
