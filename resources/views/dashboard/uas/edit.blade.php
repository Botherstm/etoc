@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" >
        <h1 class="h2">Edit Soal UAS</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dashboard/uas/{{ $uas->id}}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="mb-3">
                    <label for="soal" class="form-label">Soal</label>
                    @error('soal')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input id="soal" type="hidden" name="soal" value="{{ old('soal', $uas->soal) }}">
                    <trix-editor input="soal"></trix-editor>
                </div>
                    <div class="mb-3">
                    <label for="a" class="form-label">A</label>
                    <input type="text" class="form-control @error('a')
                        is-invalid
                    @enderror" id="a" name="a" required autofocus value="{{ old('a', $uas->a) }}">
                    @error('a')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="b" class="form-label">B</label>
                    <input type="text" class="form-control @error('b')
                        is-invalid
                    @enderror" id="b" name="b" required autofocus value="{{ old('b', $uas->b) }}">
                    @error('b')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            <div class="mb-3">
                <label for="c" class="form-label">C</label>
                <input type="text" class="form-control @error('c')
                    is-invalid
                @enderror" id="c" name="c" required autofocus value="{{ old('c', $uas->c) }}">
                @error('c')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="d" class="form-label">D</label>
                <input type="text" class="form-control @error('d')
                    is-invalid
                @enderror" id="d" name="d" required autofocus value="{{ old('d', $uas->d) }}">
                @error('d')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label for="kunci" class="form-label">Kunci Jawaban</label>
                <input type="text" class="form-control @error('kunci')
                    is-invalid
                @enderror" id="kunci" name="kunci" required autofocus value="{{ old('kunci', $uas->kunci) }}">
                @error('kunci')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
            <div class="mb-3">
                <label for="kunci" class="form-label">Kunci Jawaban</label>
                <select class="form-select form-select-sm" name="kunci" id="kunci">
                        <option value="{{ old('kunci', $uas->kunci) }}" selected>{{ $uas->kunci}}</option>
                        <option value="a">A. </option>
                        <option value="b">B. </option>
                        <option value="c">C. </option>
                        <option value="d">D. </option>
                </select>
            </div>




            <button type="submit" class="btn btn-primary d-block justify-content-center">Update !</button>
        </form>
    </div>
    <script>

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
