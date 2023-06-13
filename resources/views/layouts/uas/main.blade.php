
@extends('layouts.main')
@section('container')
    <div class="container">
    
    <!-- Tampilkan timer -->
    <div class="sticky-top bg-light py-3">
        <!-- Tampilkan waktu di sini -->
        <center><div id="timer" class="mb-5">00:00:00</div></center>
      </div>
    

    <!-- Form UTS -->
        <table border="0" class="ml-5 d-block col-md-6" >
            <thead>
            </thead>
                <tbody>
                    <form action="{{ route('/uas/jawab') }}" method="POST" name="uas-form" id="uas-form">
                        @csrf
                        @foreach ($uass as $it)
                        <input type="hidden" name="soal_id[{{$it->id}}]" value="{{$it->id}}">
                        <input type="hidden" name="kunci[{{$it->id}}]" value="{{$it->kunci}}">
                            @if ($it->gambar)
                                <tr >
                                    <td>
                                        <img class="mt-5" src="{{ asset('storage/' . $it->gambar) }}" width='150' height='150'>
                                    </td>
                                </tr>
                            @else
                                <div></div>
                            @endif
                            @if ($it->video)
                                <tr>
                                    <td>
                                        <video src="{{ asset('storage/' . $it->vidio) }}" width='100' height='100'>
                                    </td>
                                </tr>
                            @else
                                <div></div>
                            @endif
                        <tr>
                            <td>
                                <div class="input-group mb-3 mt-3">
                                <span class="input-group-text">{{ $loop->iteration }}</span>
                                <span class="input-group-text">{!!$it->soal!!}</span>
                                </div>
                            </td>
                        </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="form-check">
                                <input required class="form-check-input @error('a')
                                    is-invalid
                                @enderror"
                                type="radio" id="checkbox" name="jawaban[{{$it->id}}]" value="a" onchange="checkOnlyOne(this)" >
                                <label class="form-check-label" for="checkbox">
                                    a. {{ $it->a}}
                                </label>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="checkbox" name="jawaban[{{$it->id}}]" value="b" onchange="checkOnlyOne(this)">
                                <label class="form-check-label" for="checkbox">
                                    b. {{ $it->b}}
                                </label>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="checkbox" name="jawaban[{{$it->id}}]" value="c" onchange="checkOnlyOne(this)">
                                <label class="form-check-label" for="checkbox">
                                    c. {{ $it->c}}
                                </label>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" id="checkbox" name="jawaban[{{$it->id}}]" value="d" onchange="checkOnlyOne(this)">
                                <label class="form-check-label" for="checkbox">
                                    d. {{ $it->d}}
                                </label>
                            </div>
                            </td>
                        </tr>
                        
                        @endforeach
                        <tr class="d-flex justify-content-center py-5">
                            <td>
                                <input type="submit" class="btn btn-success" name="submit" value="Jawab" onclick="return confirm('Perhatian! Apakah Anda sudah yakin dengan semua jawaban Anda?')">
                                <input type="reset" class="btn btn-warning" value="Reset">
                            </td>
                        </tr>
                        
                    </form>
                </tbody>
            </table>
                
    <script>
        // Cek apakah waktu mulai sudah tersimpan di localStorage
        if (!localStorage.getItem('uts_start_time')) {
            // Jika belum, simpan waktu mulai di localStorage
            const now = Math.floor(Date.now() / 1000);
            localStorage.setItem('uts_start_time', now);
            startCountdown(now, {{ $endTime }});
        } else {
            // Jika sudah, lanjutkan hitung mundur
            startCountdown(parseInt(localStorage.getItem('uts_start_time')), {{ $endTime }});
        }

        // Menghitung mundur dan menampilkan timer
        function startCountdown(startTime, endTime) {
            const timerElement = document.getElementById('timer');
            const formElement = document.getElementById('uts-form');
            function updateTimer() {
                const now = Math.floor(Date.now() / 1000);
                const remainingTime = endTime - now;
                if (remainingTime > 0) {
                    const hours = Math.floor(remainingTime / 3600).toString().padStart(2, '0');
                    const minutes = Math.floor((remainingTime % 3600) / 60).toString().padStart(2, '0');
                    const seconds = (remainingTime % 60).toString().padStart(2, '0');
                    timerElement.textContent = hours + ':' + minutes + ':' + seconds;
                } else {
                    timerElement.textContent = 'Waktu habis';
                    // Kirim form secara otomatis
                    formElement.submit();
                    document.getElementById('uas-form').submit();
                }
            }
            updateTimer();
            setInterval(updateTimer, 1000);
        }
        function saveRadioButtonData() {
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        var selectedOption = '';
        radioButtons.forEach(function (radioButton) {
            if (radioButton.checked) {
                selectedOption = radioButton.value;
            }
        });
        localStorage.setItem('selected_option', selectedOption);
    }

    // Fungsi untuk memuat data radio button dari localStorage
    function loadRadioButtonData() {
        var selectedOption = localStorage.getItem('selected_option');
        if (selectedOption) {
            var radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(function (radioButton) {
                if (radioButton.value === selectedOption) {
                    radioButton.checked = true;
                }
            });
        }
    }

    // Panggil fungsi loadRadioButtonData saat halaman dimuat
    window.addEventListener('load', loadRadioButtonData);
    // Panggil fungsi saveRadioButtonData saat ada perubahan pada radio button
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(function (radioButton) {
        radioButton.addEventListener('change', saveRadioButtonData);
    });
    </script>
</div>
    @endsection