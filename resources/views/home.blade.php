@extends('layouts.main')
@section('container')
        <style>
            .hover-container {
            display: inline-block;
            position: relative;
            width: 200px;
            height: 200px;
            }
            .hover-container:hover {
            cursor: not-allowed;
            }
        </style>
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto row justify-content-center ">
                            <img src="asset/img/undiksha.png" alt="Gambar 1" style="width:400px; display:inline-block;">
                            <img src="asset/img/prodi.png" alt="Gambar 2" class="mt-3" style="width:200px; height:170px; display:inline-block;">
                    </div>
                    {{-- <div class="hover-container" id="myElement">
                    Hover disini
                    </div> --}}
                    {{-- @if ($post->count())
                        @foreach ( $post as $po )
                            <div class="col mb-4">
                                
                                <div class="card shadow-sm">
                                    <h5 class="card-title m-3">{{ $po->judul }}</h5>
                                    <iframe width="280" height="180"  class="mx-auto" src="{{$po->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    <div class="card-body">
                                        <p class="card-text">{{ $po->pendek }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                            <a href="/post/{{ $po->id }}"><button type="button" class="btn btn-sm btn-outline-secondary">detail</button></a>
                                            <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary">Quiz</button></a>
                                            </div>
                                            <small class="text-muted">{{ $po->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center fs-4 ">Belum Ada Materi......</p>
                    @endif --}}
        </div>
        <script>
            var myElement = document.getElementById('myElement');

myElement.addEventListener('mouseenter', function() {
  document.body.style.cursor = "url('asset/img/stop.png') 100 100, auto";
});

myElement.addEventListener('mouseleave', function() {
  document.body.style.cursor = 'auto';
});
        </script>
@endsection
