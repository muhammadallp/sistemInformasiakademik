@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Data Users</h1>
    <a href="/users/create" class="btn btn-primary mb-3">Tambah Data</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $sw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sw->nik }}</td>
                            <td>{{ $sw->nama }}</td>
                            <td>{{ $sw->level }}</td>
                            <td>{{ $sw->photo }}</td>
                            {{-- <td>
                                <a class="btn btn-warning border-0" href="/siswa/{{$sw->slug}}/edit">  <i class="fas fa-pen "></i></a>
                                <form method="post" action="/siswa/{{$sw->slug}}" class="d-inline">
                                    @method('delete')
                                    @csrf
                                <button class="btn btn-danger border-0" onclick="return confirm('Apakah anda yakin mau dihapus?')"><span><i class="fas fa-trash "></i></span></button>
                                </form>
                            </td>  --}}
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