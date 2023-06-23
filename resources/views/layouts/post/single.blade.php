<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Pembelajaran Alwindi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");:root{--header-height: 3rem;--nav-width: 68px;--first-color: #4723D9;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}}


.slide-in {
  animation: slideIn 1s ease-in-out;
}

@keyframes slideIn {
  0% {
    transform: translateX(-100%);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

header {
    background-color: #f1f1f1;
    padding-top: 20px;
    padding: 20px;
    text-align: center;
}

header h1 {
    margin-top: 0;
    text-transform: uppercase;
}

video {
    width: 100%;
    max-width: 800px;
    max-height: 600px;
    margin: 0 auto;
}

section {
    padding: 20px;
    margin-left:auto;
    text-align: center;
}

footer {
    background-color: #f1f1f1;
    padding: 20px;
    text-align: center;
}

.download-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.download-button:hover {
    background-color: #45a049;
}
</style>

</head>
<body id="body-pd" class="slide-in">
    {{-- navbar --}}
            <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Alwindi's Website</span> </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active"> <i class="bi bi-arrow-right-circle-fill"></i> <span class="nav_name " @disabled(true)>{{ $post->judul }}</span> </a>
                    <a href="/posts/{{ $post->materi_id }}" class="nav_link "> <i class="bi bi-arrow-left-circle-fill"></i> <span class="nav_name">Kembali</span> </a>
                </div>
            </div>
            <a href="/logout" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">
                <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link px-3 bg-transparent text-white border-0">
                Logout <span data-feather="log-out"></span></button>
            </form></span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="bg-light pb-5">
            <header>
                <h1 >{{$post->judul}}</h1>
            @if ($post->video)
            <video src="{{ asset('storage/' . $post->video) }}" controls></video>
            @endif
            </header>
            @if ($post->isi)
            <section >
                <h2>Penjelasan</h2>
                <p>{!! $post->isi !!}</p>
            </section>
            @else

            @endif
            <footer>
                @if ($post->pdf)
                <a href="{{ asset('storage/' . $post->pdf) }}" download class="download-button">Download PDF</a>
                @endif
                @if ($post->ppt)
                    <a href="{{ asset('storage/' . $post->ppt) }}" download class="download-button">Download PPT</a>
                @endif
            </footer>

{{--
            <div class=" col-lg-12 col-sm-12 position-relative ">
                <div class="pt-4  position-relative row" style="max-width: 2000px; ">
                    <video width="50%"  height="25%" style="max-height: 2000px;"   class="" src="{{ asset('storage/' . $post->video) }}" frameborder="0"  allowfullscreen controls loop>Your browser does not support the video tag.</video>
                </div>
                <article class="my-5 fs-8 text-bold">
                    {!! $post->isi !!}
                </article>
                <p class="my-2">Download Materi<a href="{{ asset('storage/' . $post->pdf) }}"> <button class="btn btn-primary"> DOWNLOAD !</button></a></p> --}}


    </div>


    <!--Container Main end-->




{{--
    <div class="container bg-light">
        <div class="row my-3 bg-light">
            <div class="col-lg-6 ml-8 justify-content-center bg-light">
                <h2>{{ $post->judul }}</h2>
                <div class="pt-4">
                    <video width="500" height="300"  class="mx-auto" src="{{ asset('storage/' . $post->video) }}" frameborder="0"  allowfullscreen controls loop></video>
                </div>
                <p class="my-2">Download Materi<a href="{{ asset('storage/' . $post->pdf) }}"> <button class="btn btn-primary"> DOWNLOAD !</button></a></p>
                <article class="my-3 fs-8 my-3">

                    {!! $post->isi !!}

                </article>
            </div>
        </div>
        </div>
    </div> --}}
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('show')
// change icon
toggle.classList.toggle('bx-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

 // Your code to run since DOM is loaded and ready
});
</script>
</id=>
</html>


