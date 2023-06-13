@extends('layouts.main')
@section('container')
        <style>
            .black-link {
                color: grey;
            }
            .bold-fira-sans {
                font-weight: bold;
                font-family: "Fira Sans", sans-serif;
            }
            .capslock {
                text-transform: uppercase;
            }
            .hover-effect {
                color: #000;
                font-size: 18px;
                transition: color 0.3s ease-in-out;
            }

            .hover-effect:hover {
                color: #ff0000;
                font-size: 20px;
                text-decoration: underline;
            }
            .no-underline {
                text-decoration: none;
            }
            .fade-in {
                opacity: 0;
                animation: fadeAnimation 2s ease-in-out forwards;
            }

            @keyframes fadeAnimation {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            .responsive-text {
            font-size: 18px; /* Ukuran tulisan awal */
            }

            @media screen and (max-width: 768px) {
            .responsive-text {
                font-size: 12px; /* Ukuran tulisan untuk layar dengan lebar maksimal 768px */
            }
            }

            @media screen and (max-width: 480px) {
            .responsive-text {
                font-size: 9px; /* Ukuran tulisan untuk layar dengan lebar maksimal 480px */
            }
            }

            .responsive-button {
            font-size: 16px; /* Ukuran teks tombol awal */
            padding: 10px 20px; /* Padding tombol awal */
            }

            @media screen and (max-width: 768px) {
            .responsive-button {
                font-size: 12px; /* Ukuran teks tombol untuk layar dengan lebar maksimal 768px */
                padding: 8px 16px; /* Padding tombol untuk layar dengan lebar maksimal 768px */
            }
            }

            @media screen and (max-width: 480px) {
            .responsive-button {
                font-size: 10px; /* Ukuran teks tombol untuk layar dengan lebar maksimal 480px */
                padding: 3px 9px; /* Padding tombol untuk layar dengan lebar maksimal 480px */
            }
            }
            .video-container {
            position: relative;
            }

            .video-container video {
            width: 100%;
            height: auto;
            }

            .video-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #fff;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            }
            .image-container {
            position: relative;
            display: inline-block;
            }

            .image-container img {
            display: block;
            width: 100%;
            height: auto;
            }

            .image-caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            color: #fff;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            }
            .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Ubah nilai transparansi sesuai kebutuhan */
            z-index: 1;
            }
            .form-popup {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.form-container {
  max-width: 600px;
  padding: 20px;
  background-color: white;
  margin: 10% auto;
}

.form-container h1 {
  text-align: center;
}

.form-container label {
  font-weight: bold;
}

.form-container input[type=text] {
  width: 100%;
  height: 100px;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}


.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom: 10px;
}

.form-container .cancel {
  background-color: #ff4444;
}

/* Animasi */
@keyframes fade {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}.question-container {
  width: 300px;
  margin: 50px auto;
  text-align: center;
}

.question {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  opacity: 1;
  transition: opacity 0.5s ease;
}

        </style>
        <style>
            .not-allowed {
                cursor: not-allowed;
            }
            a#not-allowed {
                cursor: not-allowed;
            }

.form-container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .form-group textarea {
            height: 80px;
        }

        .form-group .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Styles for the popup */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            text-align: center;
        }

        .popup h2 {
            margin-top: 0;
        }

        .popup p {
            margin-bottom: 20px;
        }

        .popup .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Styles for the spinner */
        .spinner {
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 2s linear infinite;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
            
        </style>
        <div class="">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="container">
                <div class="row">
                    <h1>Daftar Sub Materi</h1>
                    {{-- @if ($materi->count())
                        @foreach ( $materi as $po )
                                    @php
                                    $route = route('materi.updateProgress', ['id' => $po->id]);
                                    $attributes = '';
                                    $warningMessage = 'Anda belum membuka data sebelumnya.';
                                        // Misalkan $nilai dari database
                                        if ($progress < $po->id) {
                                            $warningMessage = 'Anda belum membuka data sebelumnya.';
                                            $route = '#'; // Mengatur route ke "#" jika data belum dibuka
                                            $attributes = 'style="pointer-events: none; cursor: not-allowed;"'; // Mengatur atribut CSS untuk menonaktifkan tautan
                                            
                                            }
                                    @endphp
                            <div class="col mb-4 fade-in">
                                <div class="card shadow-sm">
                                    @if ($po->gambar)
                                    <a href="{{ $route }}" class="black-link">
                                    <div class="image-container ">
                                        <img class=" img-fluid " src="{{ asset('storage/' . $po->gambar) }}" width="280" height="180" alt="{{$po->judul}}">
                                        <div class="image-overlay"></div>
                                        <h2 class="image-caption">{{$po->judul}}</h2>
                                    </div>
                                        
                                    </a>
                                    @else
                                    <div class="video-container">
                                    <video class=" img-fluid" src="{{ asset('storage/' . $po->video) }}" width="280" height="180" controls></video>
                                    <h2 class="video-caption">{{$po->judul}}</h2>
                                    </div>
                                        
                                    @endif
                                    <div class="{{ $progress >= $po->id ? '' : 'not-allowed' }}">
                                        <a href="{{ $route }}" {!! $attributes !!}  id="my-link" onclick="return confirmLink(event, '{{ $warningMessage }}');">
                                        <h5 class="card-title m-3 black-link bold-fira-sans capslock hover-effect no-underline {{ $progress >= $po->id ? '' : 'not-allowed' }}">{{ $po->judul }}</h5>
                                    </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text ml-3 responsive-text" id="textContainer">{{ $po->pendek }}</p>
                                        <div class="justify-content-center d-flex ">
                                            <a href="{{ $route }}" class="{{ $progress >= $po->id ? '' : 'not-allowed' }}"><button type="button" class="btn btn-sm btn-outline-secondary responsive-button align-items-center {{ $progress >= $po->id ? '' : 'disabled' }}">detail</button></a>
                                            
                                        </div>
                                        <div class="d-flex"><small class="text-muted responsive-text align-items-center py-2">{{ $po->created_at->diffForHumans() }}</small></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center fs-4 ">Belum Ada Materi......</p>
                    @endif --}}
                    @if ($post->count())
                        @foreach ($post as $po)
                            <div class="col mb-4 fade-in">
                                <div class="card shadow-sm">
                                    @if ($po->gambar)
                                    <a href="/materi/{{$po->id}}" class="black-link">
                                    <div class="image-container ">
                                        <img class=" img-fluid " src="{{ asset('storage/' . $po->gambar) }}" width="280" height="180" alt="{{$po->judul}}">
                                        <div class="image-overlay"></div>
                                        <h2 class="image-caption">{{$po->materi->title}}</h2>
                                    </div>
                                    </a>
                                    @else
                                    <div class="video-container">
                                    <video class=" img-fluid" src="{{ asset('storage/' . $po->video) }}" width="280" height="180" controls></video>
                                    <h2 class="video-caption">{{$po->materi->title}}</h2>
                                    </div>
                                        
                                    @endif
                                    <div class="">
                                        <a href="/materi/{{$po->id}}"  id="my-link">
                                        <h5 class="card-title m-3 black-link bold-fira-sans capslock hover-effect no-underline ">{{ $po->judul }}</h5>
                                    </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text ml-3 responsive-text" id="textContainer">{{ $po->pendek }}</p>
                                        <div class="justify-content-center d-flex ">
                                            <a href="/materi/{{$po->id}}" class=""><button type="button" class="btn btn-sm btn-outline-secondary responsive-button align-items-center">detail</button></a>
                                        </div>
                                        <div class="d-flex"><small class="text-muted responsive-text align-items-center py-2">{{ $po->created_at->diffForHumans() }}</small></div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    @else
                        <p>belum ada sub materi dibuat</p>
                    @endif
        <div class="question-container d-block">
            <div class="question" id="question">
                <h3>Tugas :</h3>
                @foreach ($tugass as $tugas)
                    <p>{{ $loop->iteration }}. {{$tugas->soal}}</p>
                @endforeach
                <button class="btn btn-dark mb-2" onclick="openForm()">Kirim Jawaban</button>
            </div>
        </div>

    <div class="overlay" id="overlay">
        <div class="form-container">
            <h2>Form Pengumpulan Tugas</h2>
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="materi_id" value="{{$materi->materi->id}}" hidden >
                    @if ($text->count())
                        <div class="form-group">
                            <label for="text">Teks</label>
                            <textarea name="text" id="text" rows="3" required></textarea>
                        </div>
                    @else
                    @endif
                    @if ($pdf->count())
                    <div class="form-group">
                        <label for="pdf">PDF</label>
                        <input type="file" name="pdf" id="pdf" required>
                    </div>
                    @else

                    @endif

                    @if ($video->count())
                        <div class="form-group">
                            <label for="video">Video</label>
                            <input type="file" name="video" id="video" required>
                        </div>
                    @else
                    @endif
                    
                    @if ($gambar->count())
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" id="gambar" required>
                    </div>
                    @else
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn" onclick="submitForm()">Kirim</button>
                        <button type="button" class="btn btn-danger" onclick="closeForm()">Tidak</button>
                    </div>
                </form>
            </div>
        </div>
            {{-- <button type="button" class="btn" onclick="submitForm()">Ya</button>
            <button type="button" class="btn" onclick="closeForm()">Tidak</button>
        </div> --}}
        <div class="spinner" id="spinner"></div>
    </div>

    

    <script>
        function openForm() {
            document.getElementById('overlay').style.display = 'flex';
        }

        function closeForm() {
            document.getElementById('overlay').style.display = 'none';
        }

        function submitForm() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('spinner').style.display = 'block';

            // Simulate form submission delay
            setTimeout(function() {
                document.getElementById('spinner').style.display = 'none';
                showSuccessPopup();
            }, 3000); // Adjust the delay time as needed
        }

        function showSuccessPopup() {
            var successPopup = document.createElement('div');
            successPopup.innerHTML = `
                <div class="popup">
                    <h2>Tugas berhasil dikumpulkan!</h2>
                    <p>Terima kasih atas partisipasi Anda.</p>
                    <button type="button" class="btn" onclick="closeForm()">Tutup</button>
                </div>
            `;
            document.getElementById('overlay').appendChild(successPopup);
        }
    </script>


        
        @push('styles')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        @endpush

        @push('scripts')
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
                    
            function confirmLink(event, warningMessage) {
                if (warningMessage) {
                    // Mencegah tautan diikuti secara otomatis
                    event.preventDefault();

                    // Tampilkan pesan peringatan
                    alert(warningMessage);

                    // Mengembalikan false untuk menghentikan eksekusi tautan
                    return false;
                }

                // Lanjutkan untuk mengikuti tautan
                return true;
            }


            document.addEventListener('DOMContentLoaded', function () {
                let hoverLinks = document.querySelectorAll('.hover-link');
                hoverLinks.forEach(function (link) {
                    link.addEventListener('mouseover', function () {
                        link.style.cursor = 'default';
                    });

                    link.addEventListener('mouseout', function () {
                        link.style.cursor = 'pointer';
                    });
                });
            });
        </script>
        @endpush

        <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var paragraphsr = document.getElementById("textContainer");
                    
                    for (var i = 0; i < paragraphs.length; i++) {
                        var text = paragraphs[i].textContent;
                        var words = text.split(" ");
                        var limitedText = words.slice(0, 5).join(" ");
                        
                        paragraphs[i].textContent = limitedText;
                    }
                });
        </script>
@endsection
