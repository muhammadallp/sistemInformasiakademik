@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800 mb-3">Nilai Raport</h1>
    {{-- <a href="/siswa/create" class="btn btn-primary mb-3">Tambah Data</a> --}}

    {{-- @if ($guru === 'null')
        {{ hallo }}
    @else
         --}}
    



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nilai Raport</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Kelas</th> 
                            <th>Jenis Kelamin</th>
                            <th>Nomor HandPone</th>
                            <th>Tahun Akademik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $sw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sw->nik }}</td>
                            <td>{{ $sw->nama }}</td>
                            <td>{{ $sw->kelas }}</td>
                            <td>{{ $sw->jk }}</td>
                            <td>{{ $sw->nohp }}</td>
                            <td>{{ $sw->tahun }}</td>
                            <td>
                            <a class="btn btn-sm btn-info" href="/detailnilairaport/{{ $sw->id }}"><i class="fas fa-eye "></i></a>
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

{{-- @endif --}}
@endsection