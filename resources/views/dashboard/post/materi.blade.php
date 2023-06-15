@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" >
        <h1 class="h2">Edit Materi</h1>
    </div>
    <div class="col-lg-8">
        <form method="POST" action="/dasboard/materi/{{$materi->id}}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Materi</label>
                <input type="text" class="form-control @error('title')
                    is-invalid
                @enderror" id="title" name="title" required autofocus value="{{ old('title', $materi->title) }}">
                @error('title')
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

            <button type="submit" class="btn btn-dark d-block justify-content-center">Update !</button>
        </form>
    </div>
    <script>

    </script>
@endsection
