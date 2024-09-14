@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Absen Siswa</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Jam Pelajaran</th>
                            <th>Total Hadir</th>
                            <th>Total Izin</th>
                            <th>Total Tidak Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $key => $jadwalmapel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwalmapel->hari }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->kelas }}</td>
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $totalhadir[$key][0]->total }}</td>
                            <td>{{ $totalizin[$key][0]->totalizin }}</td>
                            <td>{{ $totalalfa[$key][0]->totalalfa }}</td>
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