@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Absensi Siswa Kelas Mata Pelajaran :</h1>
    {{-- <a href="/nilai/create" class="btn btn-primary mb-3">Tambah Data</a> --}}

 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>pertemuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pertemuan as $sw)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sw->keterangan }}</td>
                            <td>
                                <a href="/absensisiswa/{{ $slug }}/{{ $sw->id }}" class="btn btn-info"><i class="fas fa-eye "></i> </a>
                                {{-- <a class="btn btn-warning border-0" href="/sw/{{$sw->slug}}/edit">  <i class="fas fa-pen "></i></a> --}}
                              
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


   
  {{-- </div> --}}

@endsection