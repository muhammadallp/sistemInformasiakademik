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
    <a href="/jadwalmapel/create" class="btn btn-primary mb-3">Tambah Data</a>

    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Tahun AKademik</th>
                            <th>Mata Pelajaran</th>
                            <th>Semeter</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>Jam Pelajaran</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $jadwalmapel)
                        <tr>
                            <td>{{ $jadwalmapel->hari }}</td>
                            <td>{{ $jadwalmapel->tahun }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->semester }}</td>
                            <td>{{ $jadwalmapel->kelas }}</td>
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $jadwalmapel->jam_masuk }}</td>
                            <td>{{ $jadwalmapel->jam_keluar }}</td>
                            <td>
                                <a class="btn btn-warning border-0" href="/jadwalmapel/{{$jadwalmapel->slug}}/edit">  <i class="fas fa-pen "></i></a>
                                <form method="post" action="/jadwalmapel/{{$jadwalmapel->slug}}" class="d-inline ">
                                    @method('delete')
                                    @csrf
                                <button class="btn btn-danger border-0" onclick="return confirm('Apakah anda yakin mau dihapus?')"><span><i class="fas fa-trash "></i></span></button>
                                </form>
                            </td> 
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