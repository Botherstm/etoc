@extends('profile.main')
@section('container')
   <center>
     <div class="py-12 m-auto col-md-8 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    id="info"
                    x-init="setTimeout(() => show = false, 2000)"
                    class="btn btn-light text-lg text-gray-600 dark:text-gray-400 info"
                    onclick="hideinfo()"
                    >{{ __('Saved.') }}
                </p>
            @endif
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <a href="/logout"><button class="btn btn-danger">Log out !</button></a>
            </div> --}}
            <style>
                .buttons {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #4286f4;
                    color: #ffffff;
                    font-size: 16px;
                    text-decoration: none;
                    border-radius: 4px;
                    transition: background-color 0.3s ease;
                }

                .buttons:hover {
                    background-color: #56090b;
                }
                .buttons {
                padding: 10px 20px;
                background-color: #da181e;
                color: #ffffff;
                font-size: 16px;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s ease;
                border: none;
            }

            </style>
            <form action="/logout" method="POST" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @csrf
                <button type="submit" class="btn btn-danger buttons">
                     Logout !</button>
            </form>
            
            
        </div>
    </div>
   </center>
   <script>
    function hideinfo() {
                var popupForm = document.getElementById('info');
                popupForm.style.display = 'none';
            }
   </script>
@endsection

