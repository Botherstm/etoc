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

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" >
        <h1 class="h2">Edit Materi</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dashboard/post/{{ $post->id}}" id="myForm" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="materi_id" class="form-label">Materi</label>
                <select class="form-select form-select-sm" name="materi_id">
                    @foreach ($materis as $materi)
                        @if (old('materi_id',$post->materi_id) == $materi->id)
                        <option value="{{ $materi->id }}" selected>{{ $materi->title }}</option>
                        @else
                        <option value="{{ $materi->id }}">{{ $materi->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Materi</label>
                <input type="text" class="form-control @error('judul')
                    is-invalid
                @enderror" id="judul" name="judul" required autofocus value="{{ old('judul', $post->judul) }}">
                @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select form-select-sm" name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id',$post->category_id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div> --}}

            <p>Download Materi<a href="{{ asset('storage/' . $post->pdf) }}"><div class="button-group btn btn-primary bg-light">
                DOWNLOAD !</div></a></p>
            <div class="form-group">
                <label for="pdf">Masukan PDF materi :</label>
                    <input type="hidden" name="oldPdf" value="{{ $post->pdf }}">
                    <input type="file" class="form-control-file @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                @error('pdf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <video width="400" height="200"  class="mx-auto" src="{{ asset('storage/' . $post->video) }}" frameborder="0"  allowfullscreen controls loop></video>
            <div class="form-group">
                <label for="video">Masukan Video :</label>
                    <input type="hidden" name="oldvideo" value="{{ $post->video }}">
                    <input type="file" class="form-control-file @error('video') is-invalid @enderror" id="video" name="video">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Body</label>
                @error('isi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="isi" type="hidden" name="isi" value="{{ old('isi', $post->isi) }}">
                <trix-editor input="isi"></trix-editor>
            </div>
            <button type="submit" class="btn btn-dark d-block justify-content-center">Update !</button>
        </form>
        <div id="loading-overlay">
            <div class="spinner"></div>
            <div id="loading-text">Sedang mengupload data...</div>
            <div id="loading-text">Mohon tidak berpindah Tab</div>
        </div>

    </div>
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
        const judul = document.querySelector('#judul');
        const slug = document.querySelector('#slug');

        judul.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?judul='+ judul.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        });

        function previewImage(){
            const pdf=document.querySelector('#pdf');
            const imgPreview=document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(pdf.files[0]);

            oFReader.onload = function (oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endsection
