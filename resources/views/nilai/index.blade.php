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
                            <th>Jam Pelajaran</th>
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
                                     {{-- <input type="hidden" name="title" value="{{ $title }}">    --}}
                                     <button class="btn btn-info border-0" type="submit"><i class="fas fa-eye "></i></button>
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