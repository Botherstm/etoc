    {{-- <nav id="sidebarMenu sidebar" class=" sidebar col-md-3 col-lg-2 d-md-block bg-light sidebar  collapse">
        <div class="position-sticky pt-3">
            @can('admin')
            <h6 class="sidebar-heading sidebar-header d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                <span>Administrator</span>
            </h6>
            <ul class="nav flex-column sidebar-menu">
            <li class="nav-item ">
                <a class="nav-link  {{ Request::is('/dashboard')? 'active' : '' }}" aria-current="page" href="/">
                <i class="bi bi-house-fill"> </i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dashboard/mahasiswa*')? 'active' : '' }}" href="/dashboard/mahasiswa">
                <i class="bi bi-person"></i>
                    Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/dashboard/post*')? 'active' : '' }}" href="/dashboard/post">
                <i class="bi bi-file-earmark-ruled"></i>
                    Materi
                </a>
            </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('/dashboard/uts*')? 'active' : '' }}" href="/dashboard/uts">
                    <i class="bi bi-bricks"></i>
                    Soal UTS
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('/nilai*')? 'active' : '' }}" href="/nilai">
                    <i class="bi bi-bricks"></i>
                    Jawaban UTS
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('/dashboard/uas*')? 'active' : '' }}" href="/dashboard/uas">
                    <i class="bi bi-bricks"></i>
                    Soal UAS
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ Request::is('/nilai/uas*')? 'active' : '' }}" href="/nilai/uas">
                    <i class="bi bi-bricks"></i>
                    Jawaban UAS
                </a>
                </li>
            </ul>
            @endcan
        </div>
    </nav> --}}


            <div id="sidebar">
            <ul>
                <li class="{{ Request::is('/dashboards')? 'active' : '' }}"><a href="{{ route('dashboards') }}">Dashboard</a></li>
                <li class="{{ Request::is('/dashboard/mahasiswa*')? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/mahasiswa">
                        <i class="bi bi-person"></i>
                            Mahasiswa
                    </a>
                </li>
                <li class="{{ Request::is('/dashboard/post*') ? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/post">
                        <i class="bi bi-journal-text"></i>
                            Materi
                    </a>
                </li>
                <li class="{{ Request::is('/dashboard/tugas*') ? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/tugas">
                        <i class="bi bi-clipboard2-plus"></i>
                            Tugas
                    </a>
                </li>
                <li class="{{ Request::is('/dashboard/tugasjawab*') ? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/tugasjawab">
                        <i class="bi bi-clipboard2-plus"></i>
                            Tugas Jawab
                    </a>
                </li>
                <li class="{{ Request::is('/dashboard/uts*') ? 'active' : '' }}">
                    <a class="nav-link" href="/dashboard/uts">
                        <i class="bi bi-clipboard2-plus"></i>
                        Soal UTS
                    </a>    
                </li>
                <li class="{{ Request::is('/nilai*') ? 'active' : '' }}">
                    <a class="nav-link" href="/nilai">
                        <i class="bi bi-clipboard2-check"></i>
                        Jawaban UTS
                    </a>   
                </li>
                <li class="{{ Request::is('/dashboard/uas*') ? 'active' : '' }}">
                    <a class="nav-link " href="/dashboard/uas">
                        <i class="bi bi-clipboard2-plus"></i>
                        Soal UAS
                    </a>   
                </li>
                <li class="{{ Request::is('/nilaiuas') ? 'active' : '' }}">
                    <a class="nav-link" href="/nilaiuas">
                        <i class="bi bi-clipboard2-check"></i>
                        Jawaban UAS
                    </a>   
                </li>
            </ul>
        </div>