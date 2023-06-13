@extends('auth.main')
@section('container')
<style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            }

            .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            }

            .login-form {
            background-color: #fff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: slide-in 0.5s ease-in-out;
            }

            @keyframes slide-in {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
            }

            .login-form h1 {
            text-align: center;
            margin-bottom: 20px;
            }

            .form-group {
            margin-bottom: 20px;
            }

            label {
            display: block;
            font-weight: bold;
            }

            input[type="email"],
            input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            }

            button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            }

            button:hover {
            background-color: #45a049;
            }

            @media only screen and (max-width: 400px) {
            .container {
                padding: 0 20px;
            }
            }
            .login-form .row .image img {
            max-width: 170px;
            height: auto;
            margin-bottom: 20px;
            }
            .login-form .row .image2 img {
            max-width: 90px;
            height: auto;
            padding-top: 10px;
            margin-bottom: 20px;
            }
    </style>

    <div class="row justify-content-center bg-light ">
        <div class="col-lg-6">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn btn-close " data-bs-dismiss="alert">OK !</button>
        </div>
        @endif
            <main class="form-signin mb-5 mx-auto mt-4 justify-content-center container" >
                <form action="/register" method="post" class="login-form">
                    <div class="row mr-3 justify-items-center">
                        <div class="image">
                            <img src="asset/img/undiksha.png" alt="Logo">
                        </div>
                        <div class="image2">
                            <img src="asset/img/prodi.png" alt="Logo" >
                        </div>
                    </div>
                    @csrf
                    <h1 class="h3 mb-3 fw-normal mx-auto text-center form-group">Register Akun !</h1>
                    <div class="form-floating mb-2">
                        <label for="name">Name</label>
                        <input type="text" autofocus name="name" class="form-control rounded-top @error('name')
                        is-invalid
                        @enderror" id="name" placeholder="Name" required value="{{ old('nama') }}">

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email')
                        is-invalid
                        @enderror" name="email" id="email" placeholder="name@example.com" required value="{{ old('email') }}">

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2" >
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control @error('username')
                        is-invalid
                        @enderror" id="username" placeholder="username" required value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control rounded-bottom mb-3 @error('password')
                        is-invalid
                        @enderror" id="password" placeholder="Password" required >
                        <input type="checkbox" class="mb-3" value="true" onclick="myFunction()"> Tampilkan Password
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="inputPasswords" class="form-control rounded-bottom mb-3 @error('password_confirmation')
                        is-invalid
                        @enderror" id="password_confirmation" placeholder="Password" required >
                        <input type="checkbox" class="mb-3" value="true" onclick="myFunctions()"> Tampilkan Password

                    </div>


                    <button class="w-100 btn btn-lg btn-dark my-3" type="submit">Register</button>
                    {{-- <p class="mt-5 mb-3 text-muted">&copy;2022</p> --}}
                    <small class="d-block text-center mt-3">Sudah Memiliki Akun ? <a href="/login">Login !</a></small>
                </form>
                
            </main>
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        function myFunctions() {
            var x = document.getElementById("inputPasswords");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

@endsection
