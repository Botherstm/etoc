
@extends('layouts.main')
@section('container')
<style>
    .centered {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh; /* Mengatur tinggi div agar sesuai tinggi layar */
}

.center-form {
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 5px;
}

.center-form input,
.center-form button {
  display: block;
  margin-bottom: 10px;
  padding: 5px;
}

.center-form button {
  padding: 10px 20px;
}
</style>

<div class="centered">
    <form class="center-form"  method="POST" action="/uts/mulai">
        @csrf
        <input type="" placeholder="Nama" hidden>
        <button type="submit" name="submit" value="Jawab" class="btn btn-outline-success">Mulai</button>
    </form>
</div>


    @endsection