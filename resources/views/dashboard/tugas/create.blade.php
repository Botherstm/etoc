@extends('dashboard.layouts.main')

@section('container')
<style>
   #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        #loading-text {
            color: #fff;
            font-size: 16px;
            margin-top: 10px;
        }

</style>
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Tugas</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="{{ route('tugas.store') }}" id="myForm" class="mb-5 videoForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="materi_id" class="form-label">Materi</label>
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
                <label for="soal" class="form-label">Soal Tugas</label>
                <textarea  name="soal" id="soal" cols="30" rows="10" class="form-control @error('soal')
                    is-invalid
                @enderror" autofocus ></textarea>
                @error('soal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group pt-3">
                <label for="pdf">Masukan PDF Soal:</label>
                    <input type="file"  class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf"  value="{{ old('pdf') }}">
                @error('pdf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group pt-3">
                <label for="video">Masukan Video Soal : </label>
                    <input type="file"  class="form-control @error('video') is-invalid @enderror" id="video" name="video"  value="{{ old('video') }}">
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
                @enderror" id="video" name="video"  autofocus value="{{ old('video') }}">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}


            <div class="mb-3">
                <label for="gambar" class="form-label">Tambahkan Foto</label>
                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('gambar')
                    is-invalid
                @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()"  value="{{ old('gambar') }}">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-dark d-block justify-content-center">Tambah Materi</button>
        </form>
        <div id="loading-overlay">
            <div class="spinner"></div>
            <div id="loading-text">Sedang mengupload data...</div>
            <div id="loading-text">Mohon tidak berpindah Tab</div>
        </div>

    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

    <script>
         document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("myForm").addEventListener("submit", function(event) {
                document.getElementById('myForm').submit();

                var form = this;
                var loadingOverlay = document.getElementById("loading-overlay");
                var sidebarOverlay = document.getElementById("sidebar-overlay");

                // Menampilkan loading overlay dan tulisan
                loadingOverlay.style.display = "flex";
                sidebarOverlay.style.display = "block";

                
            });
        });
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
