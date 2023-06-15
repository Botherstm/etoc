@extends('dashboard.layouts.main')

@section('container')
<style>
    @keyframes slideInLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.slide-in-left {
    animation: slideInLeft 0.5s ease-in-out;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #f1f1f1;
    color: #333;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}
input,
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: border-color 0.3s;
}

input:focus,
select:focus {
    border-color: #777;
}

button[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #555;
}
</style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Mahasiswa</h1>
    </div>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
            @if ($post->skip(1)->count())
                <div class="py-3 col-lg-12">
                <form action="/dashboard/mahasiswa/delete/all" method="post" id="">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirmDelete()">Hapus Semua Pengguna Kecuali Admin</button>
                </form>
            </div>
            <div class="table-responsive col-lg-12">
                    <table class="table table-striped table-sm">
                    <thead>
                        <tr class="slide-in-left">
                        <th scope="col">no</th>
                        <th scope="col">Nama Mahasiswa</th>
                        <th scope="col">status & Tindakan</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Hapus Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($post as $po)
                    <tr class="slide-in-left">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $po->name }}</td>
                    @if ($po->acc != true)
                        <td>
                            <a href="#" class="btn btn-warning" onclick="openForm()">Pending !</a>
                        </td>
                    @else
                        <td>
                            <a href="#" class="btn btn-success" onclick="openForm()">Diterima</a>
                        </td>
                    @endif
                    @if ($po->is_admin != true)
                        <td>
                            <a href="#" class="btn btn-outline-warning" onclick="openFormAdmin()">Bukan Admin</a>
                        </td>
                    @else
                        <td>
                            <a href="#" class="btn btn-success" onclick="openFormAdmin()">Admin</a>
                        </td>
                    @endif
                    <td>
                        <form action="{{ route('users.destroy', $po->id) }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge border-0" onclick="return confirm('Are You Sure?')"><i class="bi bi-x-circle-fill text-danger p-1 mx-1"></i></button>
                        </form>
                    </td>
                    </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

                <div id="myModal" class="modal justify-content-center">
                    <div class="modal-content col-md-6 ">
                        <span class="close" onclick="closeForm()">&times;</span>
                        <h2>Ubah status Akun Mahasiswa</h2>
                        <form action="/dashboard/mahasiswa/{{$po->id}}" id="update_user" class="update_user" method="post">
                            @method('put')
                            @csrf
                            <input type="text" name="acc" hidden id="acc" value="{{$po->is_admin}}">
                            <div class="form-group">
                                <div class="dropdown">
                                <div class="form-group">
                                    <select id="dropdown" name="acc" id="acc">
                                        <option value="{{$po->acc}}">Pilih !</option>
                                        <option value="1"><div class="btn btn-success">Terima</div></option>
                                        <option value="0"><div class="btn btn-success">Pending</div></option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="return confirmupdate()">Simpan</button>
                        </form>
                        </div>
                </div>


                <div id="myModals" class="modal justify-content-center">
                    <div class="modal-content col-md-6 ">
                        <span class="close" onclick=" closeFormAdmin()">&times;</span>
                        <h2>Jadikan Admin?</h2>
                        <form action="/dashboard/mahasiswa/{{$po->id}}" id="update_admin" class="update_admin" method="post">
                            @method('put')
                            @csrf
                            <input type="text" name="acc" hidden id="acc" value="{{$po->acc}}">
                            <div class="form-group">
                                <div class="dropdown">
                                <div class="form-group">
                                    <select id="dropdown" name="is_admin" id="is_admin">
                                        <option value="{{$po->is_admin}}">Pilih !</option>
                                        <option value="1"><div class="btn btn-success">YA !</div></option>
                                        <option value="0"><div class="btn btn-success">Tidak!</div></option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="return confirmadmin()">Simpan</button>
                        </form>
                        </div>
                </div>
            @else
                <p>Belum ada Data Mahasiswa</p>
            @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>
    <script>
        function confirmDelete() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan menghapus semua pengguna kecuali admin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-users-form').submit();
            }
        });

        return false;
    }
    function confirmupdate() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan mengubah status Akun menjadi admin/tidak ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('update_user').submit();
            }
        });

        return false;
    }

    function confirmadmin() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan mengubah status Akun ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('update_admin').submit();
            }
        });

        return false;
    }
        function openForm() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myModal").style.display = "none";
        }

        function openFormAdmin() {
            document.getElementById("myModals").style.display = "block";
        }

        function closeFormAdmin() {
            document.getElementById("myModals").style.display = "none";
        }

        function changeFormContent(color) {
            var messageInput = document.getElementById('acc');

            if (color === 'acc') {
                messageInput.value = '1';
                form.setAttribute('data-value', 'true');
            } else if (color === 'red') {
                messageInput.value = '';
                form.setAttribute('data-value', 'false');
            }
        }
        function toggleDropdown() {
            var dropdown = document.getElementById('myDropdown');
            dropdown.classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName('dropdown-content');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };
    </script>
@endsection
