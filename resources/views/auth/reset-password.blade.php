
@extends('auth.main')
@section('container')
<form method="POST" action="{{ route('password.store') }}" class="col-lg-10">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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

        <!-- Password -->
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

        <!-- Confirm Password -->
        <div class="form-floating">
                        <label for="password_confirmation">Password</label>
                        <input type="password_confirmation" name="password_confirmation" id="inputPassword" class="form-control rounded-bottom mb-3 @error('password_confirmation')
                        is-invalid
                        @enderror" id="password_confirmation" placeholder="Password" required >
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button>
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection