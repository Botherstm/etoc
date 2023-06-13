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
</style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Soal UTS</h1>
        <div class="row navbar-nav ml-auto nav-item px-3">
                <form action="/dashboard/uts">
                    <div class="input-group ">
                        <input class="form-control bg-dark" type="text" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-group btn-warning" type="submit">Search</button>
                    </div>
                    {{csrf_field()}}
                </form>
        </div>
    </div>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    <div class="table-responsive col-lg-12">
        <div class="w-auto">
            <a href="/dashboard/uts/create" class="btn btn-dark mb-2">Tambah Soal Baru</a>
            @if ($waktu->count())
                @foreach($waktu as $item)
                    <tr>
                        {{-- <td>{{ $item->id }}</td>
                        <td>{{ $item->hours }} : {{ $item->minutes }}</td> --}}
                        <td>
                            <button class="btn btn-dark mb-2" onclick="openFormEdit({{ $item->id }})">Edit Waktu Ujian Tengah Semester</button>
                        </td>
                    </tr>
                @endforeach
                
            @else
                <button class="btn btn-dark mb-2" onclick="openForm()">Tambah Waktu</button>
            @endif
            @if ($active->active != false)
                <td>
                    <form action="{{ route('update-first-active') }}" method="POST" id="active-form" class="">
                    @csrf
                    <input type="number" value="0" id="active" hidden name="active" >
                    <Button class="btn btn-success mb-2" type="submit" onclick="return confirmactive()">Status Ujian : Terbuka</Button>
                </form>
                </td>
            @else
                
                <td>
                    <form action="{{ route('update-first-active') }}" method="POST" id="active-form">
                        @csrf
                        <input type="number" value="1" id="active" hidden name="active" >
                        <Button class="btn btn-warning mb-2" type="submit" onclick="return confirmactive()">Status Ujian : Tertutup</Button>
                    </form>
                </td>
            @endif
        </div>
        
        {{-- tambah waktu ujian --}}

        <div id="myModal" class="modal ">
            <div class="modal-content col-md-6 ">
                <span class="close" onclick="closeForm()">&times;</span>
                <h2>Tambah Waktu Ujian Tengah Semester</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/uts/lamauts/" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="end_time">Waktu Berakhir:</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                </div>
        </div>

            {{-- ubah waktu ujian --}}
            <div id="myModals" class="modals">
                <div class="modal-content col-md-6">
                    <span class="close" onclick="closeForm()">&times;</span>
                    <h5>Edit Waktu Ujian Akhir Semester</h5>
                    <form method="POST" action="/uts/lamauts/{{$data->id}}" id="editTimeForm">
                        @method('put')
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{$data->id}}">
                        <div class="form-group">
                            <label for="end_time">Waktu Berakhir:</label>
                            <input type="datetime-local" name="end_time" id="end_time" class="form-control" required value="{{ old('end_time', $data->end_time) }}">
                        </div>
                        <div class="form-group">
                            <label for="jam">Waktu Pengerjaan : (jam)</label>
                            <input type="number" name="jam" id="jam" class="form-control" required value="{{ old('jam', $data->jam) }}" placeholder="Jam">
                        </div>
                        <div class="form-group">
                            <label for="menit">Waktu Pengerjaan :(menit)</label>
                            <input type="int" name="menit" id="menit" class="form-control" required value="{{ old('menit', $data->menit) }}" placeholder="menit">
                        </div>
                        <!-- Tambahkan field lain sesuai kebutuhan -->
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
            @if ($post->count())
                <table class="table table-striped table-sm">
                    <thead>
                        <tr class="slide-in-left">
                        <th scope="col">no</th>
                        <th scope="col">Soal</th>
                        <th scope="col">Kunci Jawaban</th>
                        <th scope="col">Pilihan</th>
                        <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($post as $po)
                    <tr class="slide-in-left">
                    <td>{{ $loop->iteration }}</td>
                    <td>{!! $po->soal !!}</td>
                    <td>{{ $po->kunci }}</td>
                    <td>
                        <div>
                            A. {{ $po->a }}
                        </div>
                        <div>
                            B. {{ $po->b }}
                        </div>
                        <div>
                            C. {{ $po->c }}
                        </div>
                        <div>
                            D. {{ $po->d }}
                        </div>
                    </td>
                    <td>
                        {{-- <a href="/dashboard/uts/{{ $po->id }}"><i class=" p-1 mx-1 bi bi-eye-fill"></i></a> --}}
                        <a href="/dashboard/uts/{{ $po->id }}/edit"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></i></a>
                        <form action="/dashboard/uts/{{ $po->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge border-0" onclick="return confirm('Are You Sure?')"><i class="bi bi-x-circle-fill text-danger p-1 mx-1"></i></button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h5 >Belum ada Data Soal </h5>
            @endif
            
    </div>
    <script>
        function openForm() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myModal").style.display = "none";
        }
        

        document.getElementById("timeForm").addEventListener("submit", function(e) {
            e.preventDefault();
            var hours = document.getElementById("end_time").value;
            var jam = document.getElementById("jam").value;
            var jam = document.getElementById("menit").value;

            // Kirim data waktu ke endpoint menggunakan Ajax
            var formData = new FormData();
            formData.append("end_time", end_time);
            formData.append("jam", jam);
            formData.append("menit", menit);
            

            fetch("/uts/lamauts", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                closeForm(); // Tutup pop-up form setelah berhasil
                // Lakukan tindakan lain, seperti menampilkan pesan sukses atau memperbarui tampilan
            })
            .catch(error => {
                console.error(error);
                // Tampilkan pesan error atau lakukan tindakan lain jika terjadi kesalahan
            });
        });




        function confirmactive() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin akan mengubah status Ujian ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('active-form').submit();
            }
        });

        return false;
    }



//edit data lama ujian

        function openFormEdit(id, end_time) {
        document.getElementById("myModals").style.display = "block";
        document.getElementById("overlay").style.display = "block";

        // Mengisi nilai data pada form
        document.getElementById("id").value = id;
        document.getElementById("end_time").value = end_time;
        document.getElementById("jam").value = jam;
        document.getElementById("menit").value = menit;
    }
    function closeForm() {
            document.getElementById("myModals").style.display = "none";
        }
        

    </script>
@endsection
