@extends('dashboard.layouts.main')

@section('container')
<style>
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loading-spinner {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 3px solid #fff;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        color: #fff;
        font-size: 18px;
        margin-top: 20px;
    }
</style>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Materi</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dashboard/post" class="mb-5 videoForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="materi_id" class="form-label">Judul Materi</label>
                <select class="form-select form-select-sm" name="materi_id">
                    @foreach ($materi as $mat)
                        @if (old('materi_id') == $mat->id)
                        <option value="{{ $mat->id }}" selected>{{ $mat->title }}</option>
                        @else
                        <option value="{{ $mat->id }}">{{ $mat->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Sub Materi</label>
                <input type="text" class="form-control @error('judul')
                    is-invalid
                @enderror" id="judul" name="judul" required autofocus value="{{ old('judul') }}">
                @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group pt-3">
                <label for="pdf">Masukan PDF materi :</label>
                    <input type="file" required class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                @error('pdf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group pt-3">
                <label for="video">Masukan Video materi : </label>
                    <input type="file" required class="form-control @error('video') is-invalid @enderror" id="video" name="video">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <label for="video" class="form-label">Link Video Materi</label>
                <input type="text" class="form-control @error('video')
                    is-invalid
                @enderror" id="video" name="video" required autofocus value="{{ old('video') }}">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}


            <div class="mb-3">
                <label for="gambar" class="form-label">Foto Tumbnail</label>
                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('gambar')
                    is-invalid
                @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Penjelasan Materi</label>
                @error('isi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
                <trix-editor input="isi"></trix-editor>
            </div>

            <div class="justify-content-center">
                <button type="submit" class="btn btn-dark d-block justify-content-center">Tambah Materi</button>
            </div>
        </form>
        <div id="loadingOverlay" class="loading-overlay">
                <div class="loading-spinner"></div>
                <p class="loading-text">Sedang mengupload data...</p>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script>
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
    </script>
    <script>
        // const judul = document.querySelector('#judul');\
        // judul.addEventListener('change', function(){
        //     fetch('/dashboard/post/checkSlug?judul='+ judul.value)
        //     .then(response => response.json())
        // });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        function previewImage(){
            const image=document.querySelector('#gambar');
            const imgPreview=document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }









    </script>
@endsection
