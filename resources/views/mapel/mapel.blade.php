@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Data Mata Pelajaran</h1>
    <a href="/mapel/create" class="btn btn-primary mb-3">Tambah Data</a>
    <!-- Button trigger modal -->
  <!-- Button trigger modal -->

  
  
  
 
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
                            <th>Nomor</th>
                            <th>Mata Pelajaran</th>
                            <th>KBM</th>
                            <th>Kelompok</th>
                            {{-- <th>Waktu dibuat</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($mapels as $mapel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$mapel->mapel  }}</td>
                            <td>{{ $mapel->kbm}}</td>
                            <td>{{ $mapel->kelompok}}</td>
                            {{-- <td>{{ $mapel->created_at }}</td> --}}
                            <td>
                                <a class="btn btn-warning border-0" href="/mapel/{{$mapel->slug}}/edit">  <i class="fas fa-pen "></i></a>
                                {{-- <a class="btn btn-warning border-0" href="/mapel/posts/{{$mapel->slug}}">  <i class="fas fa-pen "></i></a> --}}
                                <form method="post" action="/mapel/{{$mapel->slug}}" class="d-inline">
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