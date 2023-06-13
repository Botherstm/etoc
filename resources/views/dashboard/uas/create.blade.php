@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Soal UAS</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dashboard/uas" class="mb-5" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Soal</label>
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
                <label for="video" class="form-label">Video Soal</label>
                <div id="videoInfo" style="display: none;">
                    <video id="videoview" width="100" height="100" controls></video>
                    <p id="videoName"></p>
                    <p id="videoSize"></p>
                    <p id="videoType"></p>
                </div>
                <input class="form-control @error('video')
                    is-invalid
                @enderror" type="file" id="video" name="video" onchange="previewImage()">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="soal" class="form-label">Soal</label>
                @error('soal')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="soal" type="hidden" name="soal" value="{{ old('soal') }}">
                <trix-editor input="soal"></trix-editor>
            </div>

            <div class="mb-3 mr-5">
                <label for="a" class="form-label">pilihan A :</label>
                <input type="text" class="form-control @error('a')
                    is-invalid
                @enderror" id="a" name="a" required autofocus value="{{ old('a') }}">
                @error('a')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3  mr-5">
                <label for="b" class="form-label">pilihan B :</label>
                <input type="text" class="form-control @error('b')
                    is-invalid
                @enderror" id="b" name="b" required autofocus value="{{ old('b') }}">
                @error('b')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3  mr-5">
                <label for="c" class="form-label">pilihan C :</label>
                <input type="text" class="form-control @error('c')
                    is-invalid
                @enderror" id="c" name="c" required autofocus value="{{ old('c') }}">
                @error('c')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3  mr-5">
                <label for="d" class="form-label">pilihan D :</label>
                <input type="text" class="form-control @error('d')
                    is-invalid
                @enderror" id="d" name="d" required autofocus value="{{ old('d') }}">
                @error('d')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mr-5">
                <label for="kunci" class="form-label">Jawaban Yang Benar</label>
                <select class="form-select form-select-sm @error('kunci')
                    is-invalid
                @enderror" name="kunci" >
                @error('kunci')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                        <option value="a" selected>A. </option>
                        <option value="b">B. </option>
                        <option value="c">C. </option>
                        <option value="d">D. </option>

                </select>
                
            </div>
            
            </div>

            
            <div class="justify-content-center ml-5 mb-5">
                <button type="submit" class="btn btn-dark d-block justify-content-center">Tambah Materi</button>
            </div>
        </form>

    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script>


        const judul = document.querySelector('#judul');

        judul.addEventListener('change', function(){
            fetch('/dashboard/uts/checkSlug?judul='+ judul.value)
            .then(response => response.json())
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        function previewImage(){
            const image=document.querySelector('#gambar');
            const imgPreview=document.querySelector('.videoview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }


        document.addEventListener("DOMContentLoaded", function() {
            var video = document.getElementById("videoview");
            var videoInput = document.getElementById("video");
            var videoInfo = document.getElementById("videoInfo");
            var videoName = document.getElementById("videoName");
            var videoSize = document.getElementById("videoSize");
            var videoType = document.getElementById("videoType");

            videoInput.addEventListener("change", function(e) {
                var file = e.target.files[0];
                var url = URL.createObjectURL(file);
                video.setAttribute("src", url);
                videoInfo.style.display = "block";
                videoName.textContent = "Video Name: " + file.name;
                videoSize.textContent = "Video Size: " + formatBytes(file.size);
                videoType.textContent = "Video Type: " + file.type;
            });

            function formatBytes(bytes) {
                if (bytes === 0) return "0 Bytes";
                var k = 1024;
                var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
                var i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
            }
            });






    </script>
@endsection
