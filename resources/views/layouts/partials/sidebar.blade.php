    {{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky">

                <ul class="nav d-block flex-column col">
                @foreach ( $post as $po)


                <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-dark hover-zoom" style="width: 380px; .hover-effect:hover {opacity: 0.5;}">
                    <svg class="bi me-2 bg-dark" width="10" height="24"><use xlink:href="#bootstrap"></use></svg>
                    <div class="list-group list-group-flush border-bottom scrollarea bg-dark">
                    <a href="/layouts/post/{{ $po->id }}" class="list-group-item list-group-item-action py-3 lh-tight">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">{{ $po->judul }}</strong>
                        <small class="text-muted">{{ $po->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-10 mb-1 small">{{ $po->pendek }}</div>
                    </a>
                    </div>
                </div>
                @endforeach
            </ul> --}}

    <div class="l-navbar flex-column" id="nav-bar">
        <nav class="nav">

            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Alwindi's Website</span> </a>
                <div class="nav_list">
                    {{-- <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Home</span> </a>
                    <a href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>
                                        <a href="/materi" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Materi</span> </a>
                    <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">soal</span> </a>  --}}
                    <a href="/" class="nav_link nav-item {{ Request::is('/') ? 'active' : '' }}"><i class="bi bi-house-door-fill"></i> <span class="nav_name">Home</span> </a>

                    {{-- <li class="nav_link dropdown">

                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left: -15px">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                        Materi !!
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <li>
                        @foreach ( $post as $po)
                        <li><hr class="dropdown-divider"></li>

                        <a href="/layouts/post/{{ $po->id }}" class="nav_link {{ Request::is('materi') ? 'active' : '' }}"><strong class="nav_name text-black hover-effect"> <h6>{{ $loop->iteration }}</h6> {{$po->judul}}</strong> </a>
                        @endforeach
                        </li>
                    </ul>
                </li> --}}
                <a href="/daftar/materi" class="nav_link nav-item {{ Request::is('/materi*') ? 'active' : '' }}"><i class="bi bi-grid-3x3-gap-fill"></i> <span class="nav_name">Materi</span> </a>
                </div>
                @if ($hidup != false)
                    <a href="/uts/mulai" class="nav_link {{ Request::is('/uts*') ? 'active' : '' }}"><i class="bi bi-journal-text"></i><span class="nav_name {{ Request::is('/uts') ? 'active' : '' }}">UTS</span> </a>
                @else

                @endif
                @if ($uas != false)
                    <a href="/uas/mulai" class="nav_link {{ Request::is('/uas*') ? 'active' : '' }}"><i class="bi bi-journal-text"></i><span class="nav_name {{ Request::is('/uas') ? 'active' : '' }}">UAS</span> </a>
                @else

                @endif
                @can('admin')
                    <a href="/dashboards" id="hp" class="nav_link hp" target="_blank"> <i class="bi bi-pc-display-horizontal"></i> <span class="nav_name">Dashboard</span> </a>
                @endcan
                <a href="/profile" class="nav_link"> <i class="bi bi-person"></i> <span class="nav_name">Account</span> </a>


            <form action="/logout" method="POST" class="nav_link p-4 sm:p-8 dark:bg-gray-800 shadow sm:rounded-lg ">
                @csrf
                <button type="submit" class="btn btn-danger buttons">
                     Logout !</button>
            </form>
            </div>
        </nav>
    </div>

<style>
     .hp {
        display: none;
        }
</style>
    <script>
    function detectDevice() {
            var deviceTypeHp = document.getElementById('hp');
            var deviceTypeLaptop = document.getElementById('deviceTypeLaptop');

            // Periksa lebar layar browser untuk menentukan jenis perangkat
            if (window.innerWidth <= 1068) {
                deviceTypeHp.classList.remove('hp');
            } else {
                deviceTypeHp.classList.add('hp');
            }
        }

        // Panggil fungsi detectDevice saat halaman dimuat
        window.addEventListener('load', detectDevice);
    </script>
