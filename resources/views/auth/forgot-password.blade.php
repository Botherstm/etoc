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

.forgot-password-form {
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

.forgot-password-form h1 {
  text-align: center;
  margin-bottom: 20px;
}

.forgot-password-form p {
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

input[type="email"] {
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
</style>
<div class="col-lg-10 pt-5 mb-4 text-bold text-gray-600 dark:text-gray-400 ">
        {{ __('lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan setel ulang kata sandi melalui email yang memungkinkan Anda memilih yang baru.') }}
    </div>

    <!-- Session Status -->
    @if(session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" class="col-lg-10 forgot-password-form" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
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

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-primary">
                {{ __('Kirim Reset Password') }}
            </button>
        </div>
    </form>
@endsection
    
