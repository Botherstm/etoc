@extends('layouts.main')
@section('container')
        
        <div class="">
            <div class="container">
                <div class="row">

                    @if ($post->count())
                        @foreach ( $post as $po )
                            <div class="col mb-4">
                                
                                <div class="card shadow-sm">
                                    <h5 class="card-title m-3">{{ $po->judul }}</h5>
                                    {{-- <video width="280" height="180" class="mx-auto" src="{{ asset('storage/' . $po->video) }}" frameborder="0"  allowfullscreen controls loop></video> --}}
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
                    @endif
        </div>
        
@endsection
