@extends('dashboard.layouts.main')

@section('container')
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
        <h1 class="h2">Edit Tugas</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dashboard/tugas/{{ $tugas->id}}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="mb-3">
                <label for="materi_id" class="form-label">Materi</label>
                <select class="form-select form-select-sm" name="materi_id">
                    @foreach ($materis as $materi)
                        @if (old('materi_id',$tugas->materi_id) == $materi->id)
                        <option value="{{ $materi->id }}" selected>{{ $materi->title }}</option>
                        @else
                        <option value="{{ $materi->id }}">{{ $materi->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            {{-- <input type="text" hidden name="materi_id" value="{{$tugas->materi_id}}"> --}}
            <div class="mb-3">
                <label for="soal" class="form-label">Soal Tugas</label>
                <textarea cols="30" rows="10" id="soal" name="soal" class="form-control @error('soal')
                    is-invalid
                @enderror" required autofocus>{{ $tugas->soal}}</textarea>
                @error('soal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if ($tugas->pdf)
                <p>Download Materi<a href="{{ asset('storage/' . $tugas->pdf) }}"><div class="button-group btn btn-primary bg-light">
                DOWNLOAD !</div></a></p>
            @endif
            <div class="form-group">
                <label for="pdf">Masukan PDF materi :</label>
                    <input type="hidden" name="oldPdf" value="{{ $tugas->pdf }}">
                    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf">
                @error('pdf')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if ($tugas->video)
                <video width="400" height="200"  class="mx-auto" src="{{ asset('storage/' . $tugas->video) }}" frameborder="0"  allowfullscreen controls loop></video>
            @endif
            <div class="form-group">
                <label for="video">Masukan Video :</label>
                    <input type="hidden" name="oldVideo" value="{{ $tugas->video }}">
                    <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video">
                @error('video')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gambar" class="form-label">Foto soal</label>
                <input type="hidden" name="oldGambar" value="{{ $tugas->gambar }}">
                @if ($tugas->gambar)
                    <img src="{{ asset('storage/' . $tugas->gambar) }}" alt="" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('gambar')
                    is-invalid
                @enderror" type="file" id="gambar" name="gambar" onchange="previewImage()">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary d-block justify-content-center">Update !</button>
        </form>
    </div>
    <script>
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
            const pdf=document.querySelector('#gambar');
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
