@extends('auth.main')
@section('container')

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

    .verify-email-box {
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

    .verify-email-box h1 {
    text-align: center;
    margin-bottom: 20px;
    }

    .verify-email-box p {
    text-align: center;
    margin-bottom: 20px;
    }

    button.resend-verification,
    a.logout {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    }
    button.resend-verifications,
    a.logout {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #b82828;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    }

    button.resend-verification:hover,
    a.logout:hover {
    background-color: #45a049;
    }
    

    @media only screen and (max-width: 400px) {
    .container {
        padding: 0 20px;
    }
    }
</style>

<div class="body">
    <div class="container">
    <div class="verify-email-box">
      <h1>Verifikasi Email</h1>
      <p class="">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email yang lain kepada Anda.') }}
    </p>
    @if (session('status') == 'verification-link-sent')
        <h6 class="">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </h6>
    @endif
    <div class="mt-4 items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div >
                    <button class="btn btn-primary resend-verification">
                        {{ __('Kirim Ulang Verifikasi') }}
                    </button>
                </div>
            </form>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="resend-verifications">
                    Log out
                </button>
            </form>
        </div>
    </div>
  </div>
</div>



<div class="body">
    <div class="container">
        <p class="verify-email-box">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email yang lain kepada Anda.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <p class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </p>
    @endif

        <div class="mt-4 items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div >
                    <button class="btn btn-primary resend-verification">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

            <form method="POST" action="/logout" class="pt-3">
                @csrf
                <button type="submit" class=" btn btn-dark underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Log out
                </button>
            </form>
        </div>
    </div>
</div>


@endsection
    