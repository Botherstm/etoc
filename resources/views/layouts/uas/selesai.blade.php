
@extends('layouts.main')
@section('container')
<style>
    .badan {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 36px;
            color: #333333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #666666;
            margin-bottom: 40px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4286f4;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2c5cb7;
        }
    </style>

    <div class="my-auto badan">
        <div class="container">
            <h1>Selamat!</h1>
            <p>Anda sudah mengerjakan Ujian Akhir Semester.</p>
            <a href="/" class="button">Kembali</a>
        </div>
    </div>


    <script>
        //TODO
    </script>
    @endsection