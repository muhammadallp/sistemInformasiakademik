@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Data Nilai {{ $title }} | SMPN 1</h1>
    {{-- <a href="/guru/create" class="btn btn-primary mb-3">Tambah Data</a> --}}

    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>SKS</th>
                            <th>semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $jadwalmapel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->kelas }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $jadwalmapel->semester }}</td>
                            <td>
                                <form action="/nilaiujian/{{$jadwalmapel->slug}}" method="GET">
                                    <input type="hidden" name="title" value="{{ $title }}">   
                                    <button class="btn btn-info border-0" type="submit"><i class="fas fa-eye "></i></button>
                                   {{-- <a class="btn btn-info border-0" href="/jadwalmapel/{{$jadwalmapel->slug}}">  <i class="fas fa-eye "></i></a> --}}
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