@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Data Pertemuan</h1>
    <a href="/pertemuan/create" class="btn btn-primary mb-3">Tambah Data</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Pertemuan</th>
                            <th>Tanggal </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pertemuan as $pt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pt->keterangan }}</td>
                            <td>{{ $pt->tanggal }}</td>
                            <td>
                                <a class="btn btn-warning border-0" href="/pertemuan/{{$pt->id}}/edit">  <i class="fas fa-pen "></i></a>
                                <form method="post" action="/pertemuan/{{$pt->id}}" class="d-inline">
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