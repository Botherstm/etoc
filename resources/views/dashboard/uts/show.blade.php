@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8 justify-content-center">
                <h2>{{ $post->soal }}</h2>
                <a href="/dashboard/post" class="btn btn-success"> <i class="bi bi-arrow-left-circle"></i> Kembali</a>
                <a href="/dashboard/post/{{ $post->id }}/edit" class="btn btn-warning"> <i class="bi bi-pencil-square"></i> Edit</a>
                <form action="/dashboard/post/{{ $post->id }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i class="bi bi-x-circle-fill"></i>Delete</button>
                </form>

                <div class="pt-4">
                    <iframe width="500" height="300"  class="mx-auto" src="{{$post->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <p class="my-2">Download Materi<a href="{{ asset('storage/' . $post->pdf) }}"> DOWNLOAD !</a></p>
                <article class="my-3 fs-8">

                    {!! $post->isi !!}

                </article>
            </div>
        </div>
    </div>
@endsection
