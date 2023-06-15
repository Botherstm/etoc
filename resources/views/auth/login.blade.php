@extends('auth.main')
@section('container')
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf --}}

        <!-- Email Address -->
        {{-- <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <!-- Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
{{-- 
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}
{{-- 
            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

    <style>
        .body {
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
            max-width: 150px;
            height: auto;
            margin-bottom: 20px;
            }
            .login-form .row .image2 img {
            max-width: 80px;
            height: auto;
            padding-top: 10px;
            margin-bottom: 20px;
            }
    </style>
    <div class="row justify-content-center bg-light body">
        
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
            <main class="form-signin  mb-5 mx-auto mt-4 justify-content-center container" >
                <form action="/login" method="post" class="login-form">
                    
                    @csrf
                    <div class="row mr-3 justify-items-center">
                        <div class="image">
                            <img src="asset/img/undiksha.png" alt="Logo">
                        </div>
                        <div class="image2">
                            <img src="asset/img/prodi.png" alt="Logo" >
                        </div>
                    </div>
                    <h1 class="h3 mb-3 fw-normal mx-auto text-center form-group">Login !</h1>
                    <div class="form-floating mb-2">
                        <label for="email">Email address</label>
                        <input type="email" name="email" autofocus class="form-control @error('email')
                            is-invalid
                        @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-5">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
                    <input type="checkbox" class="mb-5" value="true" onclick="myFunction()"> Tampilkan Password
                    </div>
                    {{-- <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                    </div> --}}
                    
                    {{-- <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div> --}}
                    
                    <button class="w-100 btn btn-lg btn-dark" type="submit">Login</button>
                    {{-- <p class="mt-5 mb-3 text-muted">&copy;2022</p> --}}
                    <small class="d-block text-center mt-3">Belum Memiliki Akun ? <a href="/register">Register !</a></small>
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
    </script>

@endsection