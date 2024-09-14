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
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
        Tamnbah Data
      </button>
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
                            <th>Nomor Induk Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Hadir</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $abn)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $abn->nik }}</td>
                            <td>{{ $abn->nama }}</td>
                            <td>
                                @if($abn->status == 0 )
                                Tidak Hadir
                                @else
                                Hadir
                                @endif
                            </td>
                            <td>{{ $abn->keterangan }}</td>
                            <td>{{ $abn->created_at }}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/absensi/">
            <div class="modal-body">
                @csrf
             
                <div class="form-group">
                    <label for="nohp">NIS </label>
                    <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel" value="{{ $siswa->nik }} " disabled readonly >
                    @error('mapel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Siswa</label>
                    <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                    <input type="hidden" name="id_jadmapel" value="{{ $namasiswa->id }}">
                    <input type="hidden" name="slug" value="{{ $namasiswa->slug }}">
                    <input type="hidden" name="id_guru" value="{{ $namasiswa->guru_id }}">
                    <input type="text" name="sks" class="form-control" id="sks"  value="{{ $siswa->nama }}"  disabled readonly>
                    
                </div> 
                <div class="form-group">
                    <input type="hidden" name="jadmapel_id" class="form-control"  >
                    <input type="hidden" name="kelas_id" class="form-control"  >
                </div> 
                <div class="form-group">
                    <label for="jk">Absen</label>
                    <select class="form-control" name="status" id="nip">
                        <option selected disabled> Silahkan Pilih Absensi</option>
                        
                        <option value="1" selected>Hadir</option>
                        <option value="0" selected>Tidak Hadir</option>
                        
                    </select>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="nilai"  >
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

@endsection