<section>
    <style>
        
        .body {
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

        .hidden-form {
            display: none;
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
        .button-gambar {
            display: inline-block;
            padding: 5px 5px;
            background-color: #1e2e48;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2c5cb7;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Pop-up Form */
        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .popup-form .form-content {
            position: relative;
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
        }

        .popup-form .form-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .popup-form .form-content .form-group {
            margin-bottom: 20px;
        }

        .popup-form .form-content .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .popup-form .form-content .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
        }

        .popup-form .form-content .form-group .error-message {
            color: red;
            margin-top: 5px;
        }

        .popup-form .form-content .form-actions {
            text-align: right;
        }

        .popup-form .form-content .form-actions button {
            padding: 10px 20px;
            background-color: #4286f4;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .popup-form .form-content .form-actions button:hover {
            background-color: #2c5cb7;
        }

        //gambar user
        .image-container {
            position: relative;
            display: inline-block;
            max-width:40%;
        }

        .image-container img {
            display: block;
            margin: 0 auto;
            max-width: 40%;
            
            height: auto;
            cursor: pointer;
        }.image-container img:hover {
            display: block;
            margin: 0 auto;
            max-width: 50%;
            height: auto;
            cursor: pointer;
        }

        .popup-form-gambar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .popup-form-gambar .form-content {
            position: relative;
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
        }

        .popup-form-gambar .form-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .popup-form-gambar .form-content .form-group {
            margin-bottom: 20px;
        }

        .popup-form-gambar .form-content .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .popup-form-gambar .form-content .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
        }

        .popup-form-gambar .form-content .form-group .error-message {
            color: red;
            margin-top: 5px;
        }

        .popup-form-gambar .form-content .form-actions {
            text-align: right;
        }

        .popup-form-gambar .form-content .form-actions button {
            padding: 10px 20px;
            background-color: #4286f4;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .popup-form-gambar .form-content .form-actions button:hover {
            background-color: #2c5cb7;
        }



    </style>
    <div class="container">
        <h1>Informasi Profil</h1>
        <div class="image-container">
            <img src="asset/img/undiksha.png" alt="User Image" onclick="showPopupFormGambar()">
        </div>
        <button class="button button-gambar" onclick="showPopupFormGambar()">Ubah Foto Profil</button>
        <p>Nama : {{$user->name}}</p>
        <p>Nama : {{$user->email}}</p>
        <button class="button" onclick="showPopupForm()">Ubah Profil</button>

        <div class="popup-form-gambar" id="popupformgambar">
            <div class="form-content">
                <form action="/profile" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="gambar" class="form-label">Foto Tumbnail</label>
                    <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('gambar')
                        is-invalid
                    @enderror" type="file" id="gambar" value="{{ old('gambar', $user->gambar) }}" name="gambar" onchange="previewImage()">
                    @error('gambar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-outline-primary">Update Image</button>
            </form>
            </div>
        </div>


        <div class="popup-form" id="popupForm">
            <div class="form-content">
                <h2>Ubah Profil</h2>
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <form method="post" action="/profile" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name" :value="__('Name')" >Nama :</label>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="form-group">
                        <label for="email" :value="__('Email')" >Email : </label>
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button class="btn btn-primary">{{ __('Save') }}</button>
                        <button type="button" class="btn btn-danger" onclick="hidePopupForms()">Batal</button>
                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <script>
            function previewImage(){
                const image=document.querySelector('#gambar');
                const imgPreview=document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function (oFREvent){
                    imgPreview.src = oFREvent.target.result;
                }
            }
            function showPopupForm() {
                var popupForm = document.getElementById('popupForm');
                popupForm.style.display = 'block';
            }

            function hidePopupForms() {
                var popupForm = document.getElementById('popupForm');
                popupForm.style.display = 'none';
            }
            
            
            function showPopupFormGambar() {
                var popupForm = document.getElementById('popupformgambar');
                popupForm.style.display = 'block';
            }

            function hidePopupFormGambar() {
                var popupForm = document.getElementById('popupformgambar');
                popupForm.style.display = 'none';
            }
        </script>
</section>
