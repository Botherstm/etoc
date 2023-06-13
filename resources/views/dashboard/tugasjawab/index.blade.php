@extends('dashboard.layouts.main')

@section('container')
<style>
.table-responsive {
  display: block;
  overflow-x: auto;
  white-space: nowrap;
}

.table-responsive img,
.table-responsive video {
  max-width: 100%;
  height: auto;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Jawaban Tugas</h1>
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
        @if ($tugas->count())
        <div class="table table-striped table-sm pb-5">
            <table class=" table-responsive"> 
            <thead class="table table-striped table-sm">
                <tr class="slide-in-left">
                    <th scope="col">no</th>
                    <th scope="col">nama</th>
                    <th scope="col">Materi</th>
                    <th scope="col">Jawaban</th>
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
                        <td>{{ $mat->author->name }}</td>
                        <td>{{ $mat->materi->title }}</td>
                        <td>{{ $mat->text }}</td>
                        <td>
                            @if ($mat->gambar)
                                <img src="{{ asset('storage/' . $mat->gambar) }}" alt="Gambar Jawaban" width="200" height="200">
                            @else
                                ----
                            @endif
                        </td>
                        <td>
                            @if ($mat->video)
                                <video src="{{ asset('storage/' . $mat->video) }}" width="220" height="140" controls></video>
                            @else
                                -----
                            @endif
                        </td>
                        <td>
                            @if ($mat->pdf)
                                <a href="{{ asset('storage/' . $mat->pdf) }}" target="_blank">PDF Jawaban</a>
                            @else
                                ----
                            @endif
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>belum ada data tugas</p>
    @endif

{{-- TODO --}}


    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        
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
            document.getElementById("myForm").style.display = "none";
        }
        function openFormmateri() {
            document.getElementById("form-update").style.display = "none";
        }

        function closeFormmateri() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
@endsection
