@extends('layouts.main')
@section('container')
        <style>
        .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        }
        
        .card {
        flex: 0 0 300px;
        margin: 20px;
        border-radius: 5px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        }
        
        .card:hover {
        transform: scale(1.05);
        }
        
        .card-image {
        width: 100%;
        height: 200px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        }
        
        .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        }
        
        .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
        }
        
        .card-title a {
        text-decoration: none;
        color: #fff;
        }
        </style>
        <style>
            .not-allowed {
                cursor: not-allowed;
            }
            a#not-allowed {
                cursor: not-allowed;
            }

        </style>
        {{-- <div class="card-container">
            @foreach($materi as $mat)
            @php
                    $attributes = '';
                    $warningMessage = 'Anda belum membuka data sebelumnya.';
                    // Misalkan $nilai dari database
                    if ($progress < $mat->id) {
                        $warningMessage = 'Anda belum membuka data sebelumnya.';
                $route = '#'; // Mengatur route ke "#" jika data belum dibuka
                $attributes = 'style="pointer-events: none; cursor: not-allowed;"'; // Mengatur atribut CSS untuk menonaktifkan tautan
                }
            @endphp
            <div class="card animate__animated animate__fadeIn {{ $progress >= $mat->id ? '' : 'not-allowed' }}">
            <h2 class="card-title">
                <a href="/posts/{{ $mat->id }}" {!! $attributes !!} target="_blank">{{ $mat->title }}</a>
            </h2>
            </div>
            @endforeach
        </div> --}}

        <div class="card-container">
            @foreach($materi as $mat)
            @php
                    $attributes = '';
                    $warningMessage = 'Anda belum membuka data sebelumnya.';
                    // Misalkan $nilai dari database
                    if ($progress < $mat->id) {
                        $warningMessage = 'Anda belum membuka data sebelumnya.';
                $route = '#'; // Mengatur route ke "#" jika data belum dibuka
                $attributes = 'style="pointer-events: none; cursor: not-allowed;"'; // Mengatur atribut CSS untuk menonaktifkan tautan
                }
            @endphp
            <div class="card animate__animated animate__fadeIn {{ $progress >= $mat->id ? '' : 'not-allowed' }}">
            <div class="card-image" style="background-image: url('{{ asset('asset/img/undiksha.png') }}');"></div>
            <div class="card-content">
                <div class="card-title">
                    <a href="/posts/{{ $mat->id }}" {!! $attributes !!} target="_blank">{{ $mat->title }}</a>
                </div>
            </div>
            </div>
            @endforeach
        </div>
@endsection
