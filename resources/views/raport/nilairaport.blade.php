@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Nilai Raport  </h1>
    {{-- <a href="/nilairaport" class="btn btn-info mb-3">Kembali</a> --}}
    {{-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
        Tamnbah Data
      </button> --}}
      <form action="/cetak-raport" method="GET" class="mb-3">
        <input type="hidden" name="year" id="year" value="{{ $siswa->id }}">
        <input type="hidden" name="semester" id="semester" value="{{ $siswa->semester }}">
        <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                         
                            <th>Nama Siswa</th>
                            <th>Matapelajaran</th>
                            <th>KBM</th>
                            <th>Jam Pelajaran</th>
                            <th>Kelas</th>
                            <th>Nilai</th>
                            <th>Nilai Sikap</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilairaport as $jadwalmapel)
                        <tr>
                         
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->kbm }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $jadwalmapel->kelas_id}}</td>
                            <td>{{ $jadwalmapel->nilai_raport}}</td>
                            <td>{{ $jadwalmapel->sikap}}</td>
                            <td>
                                <button type="button" class="btn btn-warning border-0" data-toggle="modal" data-target="#edit{{$jadwalmapel->id}}">
                                    <i class="fas fa-pen "></i>
                                  </button>
                                <form method="post" action="/nilairaport/{{$jadwalmapel->id}}" class="d-inline ">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
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


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/nilairaport/">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Siswa</label>
                    <input type="text"  class="form-control" id="sks" value="{{ $siswa->nama }}"  disabled readonly>
                </div> 
                <div class="form-group">
                    <label for="jk">Matapelajaran</label>
                    <select class="form-control" name="mapel_id" id="nip">
                        <option selected disabled> Silahkan Pilih Matapelajaran</option>
                        @foreach($jadwalmapels as $sw)
                        <option value="{{ $sw->mapel_id }}" >{{ $sw->mapel }} </option>
                         @endforeach
                    </select>
                  </div>
            
                <div class="form-group">
                    <input type="hidden" name="siswa_id" class="form-control"  value="{{ $siswa->id }}">
                    <input type="hidden" name="kelas_id" class="form-control"  value="{{ $siswa->kelas }}">
                </div> 
                <div class="form-group">
                    <input type="hidden" name="semester" class="form-control" value="{{ $siswa->semester }}">
                    <input type="hidden" name="guru_id" class="form-control" value="{{ $siswa->guru_id }}">
                    <input type="hidden" name="thnakademik_id" class="form-control" value="{{ $siswa->thnakademik_id }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Raport</label>
                    <input type="text" name="nilai" class="form-control" id="nilai"  >
                </div> 
                <div class="form-floating mb-3">
                    <label for="floatingTextareaDisabled">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextareaDisabled" ></textarea>
                  </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </div>
    </form>    
      </div>
    </div>
  </div>

   <!-- Modal Edit -->
   @foreach($nilairaport as $jadwalmapel)
   <div class="modal fade" id="edit{{$jadwalmapel->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
               <form method="post" action="/nilairaport/{{$jadwalmapel->id}}">
                   <div class="modal-body">
                       @method('put')
                       @csrf
                       @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Siswa</label>
                    <input type="text"  class="form-control" id="sks" value="{{ $siswa->nama }}"  disabled readonly>
                </div> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Matapelajaran</label>
                    <input type="text"  class="form-control" id="sks" value="{{ $jadwalmapel->mapel}}"  disabled readonly>
                </div> 
                <div class="form-group">
                    <input type="hidden" name="siswa_id" class="form-control"  value="{{ $siswa->id }}">
                    <input type="hidden" name="kelas_id" class="form-control"  value="{{ $siswa->kelas }}">
                </div> 
                <div class="form-group">
                    <input type="hidden" name="semester" class="form-control" value="{{ $siswa->semester }}">
                    <input type="hidden" name="guru_id" class="form-control" value="{{ $siswa->guru_id }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Raport</label>
                    <input type="text"  class="form-control" id="nilai_raport" value="{{ $jadwalmapel->nilai_raport}}" readonly >
                </div> 
                <div class="form-floating mb-3">
                    <label for="floatingTextareaDisabled">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextareaDisabled" ></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Edit Data</button>
               </div>
           </form>    
         </div>
       </div>
     </div>
   </div>
   @endforeach
        
  {{-- </div> --}}

@endsection