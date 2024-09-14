@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Jadwal Mata Pelajaran</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="/cetakmapel" class="btn btn-primary btn-sm ">Print PDF</a>
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables jadwalMapel</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Mata Pelajaran</th>
                            <th>Semeter</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>SKS</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $jadwalmapel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwalmapel->hari }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->semester }}</td>
                            <td>{{ $jadwalmapel->kelas }}</td>
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $jadwalmapel->jam_masuk }}</td>
                            <td>{{ $jadwalmapel->jam_keluar }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>

@endsection