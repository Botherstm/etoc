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

.toggle-button {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-button input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .animate-gambar,
        .animate-video,
        .animate-pdf {
            display: inline-block;
            margin-left: 10px;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .animate-gambar img,
        .animate-video img,
        .animate-pdf img {
            width: 20px;
            height: 20px;
        }

        .gambar-container,
        .video-container,
        .pdf-container {
            display: inline-block;
            vertical-align: middle;
        }

        .gambar-container.animate,
        .video-container.animate,
        .pdf-container.animate {
            opacity: 1;
        }
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Tugas</h1>
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
        <a href="/dashboard/tugas/create"><button class="btn btn-dark mb-2" >Tambahkan Tugas Baru</button></a>
        
        @if ($tugas->count())
        <div class="table table-striped table-sm pb-5">
            <table>
            <thead class="table table-striped table-sm">
                <tr class="slide-in-left">
                    <th scope="col">no</th>
                    <th scope="col">Soal Tugas</th>
                    <th scope="col">Materi</th>
                    <th scope="col">Text</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Video</th>
                    <th scope="col">Pdf</th>
                    <th scope="col">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tugas as $mat)
                    <tr class="slide-in-left">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mat->soal }}</td>
                        <td>{{ $mat->materi->title }}</td>
                        <td>
                            <div class="text-container{{ $mat->text_active ? ' animate' : '' }}" data-tugas-id="{{ $mat->id }}">
                                <label class="toggle-button">
                                    <input type="checkbox" class="text-toggle" data-tugas-id="{{ $mat->id }}" {{ $mat->text_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="gambar-container{{ $mat->gambar_active ? ' animate' : '' }}" data-tugas-id="{{ $mat->id }}">
                                <label class="toggle-button">
                                    <input type="checkbox" class="gambar-toggle" data-tugas-id="{{ $mat->id }}" {{ $mat->gambar_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="video-container{{ $mat->video_active ? ' animate' : '' }}" data-tugas-id="{{ $mat->id }}">
                                <label class="toggle-button">
                                    <input type="checkbox" class="video-toggle" data-tugas-id="{{ $mat->id }}" {{ $mat->video_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="pdf-container{{ $mat->pdf_active ? ' animate' : '' }}" data-tugas-id="{{ $mat->id }}">
                                <label class="toggle-button">
                                    <input type="checkbox" class="pdf-toggle" data-tugas-id="{{ $mat->id }}" {{ $mat->pdf_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <a href="/dashboard/tugas/{{ $mat->id }}/edit"><button class="btn bg-transparent"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></button></a>
                            
                            <form action="/dashboard/tugas/{{ $mat->id }}" method="POST" class="d-inline">
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
    @else
        <p>belum ada data tugas</p>
    @endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        function openFormTambah() {
            document.getElementById("myForm").style.display = "none";
        }

        function closeFormTambah() {
            document.getElementById("myForm").style.display = "none";
        }
         $(document).ready(function () {
            $('.gambar-toggle').on('change', function () {
                var tugasId = $(this).data('tugas-id');
                var isChecked = $(this).prop('checked');
                var url = '{{ route("tugas.toggle-gambar", ":id") }}';
                url = url.replace(':id', tugasId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.message);
                        // Tambahkan animasi atau perubahan tampilan lainnya jika diperlukan
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.text-toggle').on('change', function () {
                var tugasId = $(this).data('tugas-id');
                var isChecked = $(this).prop('checked');
                var url = '{{ route("tugas.toggle-text", ":id") }}';
                url = url.replace(':id', tugasId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.message);
                        // Tambahkan animasi atau perubahan tampilan lainnya jika diperlukan
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.text-container').on('click', function () {
                var tugasId = $(this).data('tugas-id');
                var container = $(this);

                if (container.hasClass('animate')) {
                    container.removeClass('animate');
                } else {
                    container.addClass('animate');
                }
            });

            $('.video-toggle').on('change', function () {
                var tugasId = $(this).data('tugas-id');
                var isChecked = $(this).prop('checked');
                var url = '{{ route("tugas.toggle-video", ":id") }}';
                url = url.replace(':id', tugasId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.message);
                        // Tambahkan animasi atau perubahan tampilan lainnya jika diperlukan
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.pdf-toggle').on('change', function () {
                var tugasId = $(this).data('tugas-id');
                var isChecked = $(this).prop('checked');
                var url = '{{ route("tugas.toggle-pdf", ":id") }}';
                url = url.replace(':id', tugasId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.message);
                        // Tambahkan animasi atau perubahan tampilan lainnya jika diperlukan
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.gambar-container, .video-container, .pdf-container').on('click', function () {
                var tugasId = $(this).data('tugas-id');
                var container = $(this);

                if (container.hasClass('animate')) {
                    container.removeClass('animate');
                } else {
                    container.addClass('animate');
                }
            });
        });

        function openFormupdate(id,soal,materi_id) {
            document.getElementById("edit-id").value = id;
            document.getElementById("edit-title").value = title;
            document.getElementById("update").style.display = "block";
        }
        function closeFormupdate() {
            document.getElementById("form-update").style.display = "none";
        }

    </script>
@endsection
