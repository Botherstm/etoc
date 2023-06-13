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
.form-popup {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.form-container {
  max-width: 400px;
  padding: 20px;
  background-color: white;
  margin: 10% auto;
}

.form-container h1 {
  text-align: center;
}

.form-container label {
  font-weight: bold;
}

.form-container input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom: 10px;
}

.form-container .cancel {
  background-color: #ff4444;
}

/* Animasi */
@keyframes fade {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Materi</h1>
            <div class="row navbar-nav ml-auto nav-item px-3">
                <form action="/dashboard/post">
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
        <button class="btn btn-dark mb-2" onclick="openFormmateri()">Tambahkan Materi Baru</button>

    <div class="table table-striped table-sm pb-5">
            <table>
            <thead class="table table-striped table-sm">
                <tr class="slide-in-left">
                    <th scope="col">no</th>
                    <th scope="col">Judul Materi</th>
                    <th scope="col">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materi as $mat)
                    <tr class="slide-in-left">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mat->title }}</td>
                        <td>
                            <button class="btn bg-transparent" onclick="openFormjudul({{ $mat->id }}, '{{ $mat->title }}')"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></button>
                            <form action="" method="POST" class="d-inline">
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

 <div class="form-popup" id="myForm">
    <form action="{{ route('judul.materi.update', $mat->id) }}" method="POST" class="form-container">
      @csrf
      @method('PUT')
      <h1>Edit Data Materi</h1>
      <input type="hidden" id="edit-id" name="id" value="">
      <label for="edit-title"><b>Title</b></label>
      <input type="text" placeholder="Enter the title" id="edit-title" name="title" required>

      <!-- Tambahkan field lainnya sesuai kebutuhan -->

      <button type="submit" class="btn">Update</button>
      <button type="button" class="btn cancel" onclick="closeFormjudul()">Close</button>
    </form>
  </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Sub Materi</h1>
    </div>
        <a href="/dashboard/post/create" class="btn btn-dark mb-2">Tambahkan Sub Materi Baru</a>
<div class="table table-striped table-sm">
    
            <table class="table table-striped  table-sm">
            <thead>
                <tr class="slide-in-left">
                <th scope="col">no</th>
                <th scope="col">Materi</th>
                <th scope="col">Sub Materi</th>
                <th scope="col">Isi Materi</th>
                <th scope="col">Penjelasan</th>
                <th scope="col">Video</th>
                <th scope="col">Tindakan</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($post as $po)
            <tr class="slide-in-left">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $po->materi->title }}</td>
            <td>{{ $po->judul }}</td>
            <td>
                <p><a href="{{ asset('storage/' . $po->pdf) }}"><button class="btn btn-primary">Download</button></a></p>
            </td>
            <td>{{ $po->pendek }} ....</td>
            <td>
                <video width="200" height="100"  class="mx-auto" src="{{ asset('storage/' . $po->video) }}" frameborder="0"  allowfullscreen controls></video>
                {{-- <iframe width="200" height="100"  class="mx-auto" src="{{ asset('storage/' . $po->video) }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
            </td>
            <td>
                <a href=""><i class=" p-1 mx-1 bi bi-eye-fill"></i></a>
                <a href="/dashboard/post/{{ $po->id }}/edit"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></i></a>
                <form action="/dashboard/post/{{ $po->id }}" method="POST" class="d-inline">
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
        <div id="myModal" class="modal ">
            <div class="modal-content col-md-6 ">
                <span class="close" onclick="closeFormmateri()">&times;</span>
                <h2>Tambah Judul Materi</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/judul/materi" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="end_time">Judul Materi</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                </div>
        </div>
    </div>

<script>
    function openFormjudul(id, title) {
      document.getElementById("edit-id").value = id;
      document.getElementById("edit-title").value = title;
      document.getElementById("myForm").style.display = "block";
    }

    function closeFormjudul() {
      document.getElementById("myForm").style.display = "none";
    }

        function openFormmateri() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeFormmateri() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
@endsection
