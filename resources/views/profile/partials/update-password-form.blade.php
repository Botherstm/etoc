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

        p {
            font-size: 18px;
            color: #666666;
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

        .button:hover {
            background-color: #2c5cb7;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Pop-up Form */
        .popup-form-password {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
        }

        .popup-form-password .form-content {
            position: relative;
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 4px;
        }

        .popup-form-password .form-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .popup-form-password .form-content .form-group {
            margin-bottom: 20px;
        }

        .popup-form-password .form-content .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .popup-form-password .form-content .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #cccccc;
        }

        .popup-form-password .form-content .form-group .error-message {
            color: red;
            margin-top: 5px;
        }

        .popup-form-password .form-content .form-actions {
            text-align: right;
        }

        .popup-form-password .form-content .form-actions button {
            padding: 10px 20px;
            background-color: #4286f4;
            color: #ffffff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .popup-form-password .form-content .form-actions button:hover {
            background-color: #2c5cb7;
        }
    </style>
    

    <div class="container">
        <button class="button" onclick="showPopupForms()">Ubah Password</button>
        <div class="popup-form-password" id="popupFormpassword">
            <div class="form-content">
                <h2>Ubah password</h2>
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="current_password" :value=" __('Current Password')" >Password lama :</label>
                        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password" :value="__('New Password')" >Password baru :</label>
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" :value="__('Confirm Password')" >Confirm Password :</label>
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button class="btn btn-primary">{{ __('Save') }}</button>
                        <button type="button" class="btn btn-danger" onclick="hidePopupForm()">Batal</button>
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.') }}
                            </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showPopupForms() {
            var popupForm = document.getElementById('popupFormpassword');
            popupForm.style.display = 'block';
        }

        function hidePopupForm() {
            document.getElementById("popupFormpassword").style.display = "none";
        }
    </script>
</section>
