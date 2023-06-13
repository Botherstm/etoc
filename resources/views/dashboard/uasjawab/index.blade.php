@extends('dashboard.layouts.main')

@section('container')

<style>
    @keyframes slideInLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.slide-in-left {
    animation: slideInLeft 0.5s ease-in-out;
}
</style>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Nilai Uts</h1>
    </div>
        @if(session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        {{-- Daftar soal--}}
        <div class="table-responsive slide-in-left">
            <table class=" col-lg-12 table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            No
                        </th>
                        <th scope="col">
                            Soal
                        </th>
                        <th scope="col">
                            Kunci jawaban
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $pu)
                    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>                
                            {!! $pu->soal !!}
                        </td>
                        <td>
                            {{ $pu->kunci }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

{{-- Jawaban dari siswa --}}
    <div class="table-responsive col-lg-12 pt-5 slide-in-left">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">no</th>
                <th scope="col">Nama</th>
                <th scope="col">Nilai</th>
                <th scope="col">Tindakan</th>
                </tr>
            </thead>
            <tbody>

            @foreach (array_reverse($hasilJawaban) as $index => $hasil)
            <tr>
                <td>{{ $loop->iteration }}</td>
                {{-- <td>Total Jawaban Benar: {{ $hasil['jawabanBenar'] }}</td> --}}
                <td>{{ $hasil['nama'] }}</td>
                <td>Nilai: {{ $hasil['nilai'] }}</td>
                <td>
                        {{-- <form action="/dashboard/uts/{{ $po->id }}" method="POST" class="d-inline">
                            @method('put')
                            @csrf
                            <button class="badge border-0" onclick="return confirm('Apakah Yakin Untuk Me RESET Jawaban UTS?')"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></button>
                        </form> --}}
                        @if ($hasil['nilai'] > 30)
                            <button class="btn btn-success" disabled="disabled">Lulus</button>
                        @elseif ($hasil['id'] > 1 &&  $hasil['nilai'] < 30)
                            <button class="btn btn-danger" disabled="disabled">Tidak Lulus !!</button>
                        @elseif ($hasil['id'] > 1 &&  $hasil['nilai'] < 30)
                            <button class="btn btn-warning" disabled="disabled">ujian Pertama</button>
                        @else
                            <a href="{{ route('user.removeUtsCompleteAt', ['id' => $hasil['id'] ]) }}" class="btn btn-warning" onclick="return confirm('Are you sure you want to remove the UTS Complete At field?')">Remidial !</a>
                        @endif
                        
                </td>
            </tr>
            @endforeach
            {{-- @foreach ($jawaban as $po)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $po->author->name }}</td>
            <td>
                <form action="/dashboard/uts/{{ $po->id }}" method="POST" class="d-inline">
                    @method('put')
                    @csrf
                    <button class="badge border-0" onclick="return confirm('Apakah Yakin Untuk Me RESET Jawaban UTS?')"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></button>
                </form>
                <a href="#"><i class="bi bi-pencil-square text-success  p-1 mx-1"></i></a>
                <form action="/nilai/{{ $po->id }}" method="POST" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge border-0" onclick="return confirm('Are You Sure?')"><i class="bi bi-x-circle-fill text-danger p-1 mx-1"></i></button>
                </form>
            </td>
            @endforeach --}}
            </tbody>
        </table>
        
    </div>

    <script>
    window.onload = function() {
            var confirmationMessage = 'Apakah Anda yakin ingin merefresh halaman ini? Data yang belum disimpan akan hilang.';
            window.addEventListener('beforeunload', function(e) {
                e.preventDefault();
                e.returnValue = confirmationMessage;
            });
        }
</script>
@endsection
