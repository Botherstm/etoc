
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
                        <i class="bi bi-clipboard2-check"></i>
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
