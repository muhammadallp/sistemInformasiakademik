@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Nilai {{$typeujian}}   {{$mapels->mapel }} Kelas {{ $mapels->kelas }}</h1>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#staticBackdrop">
        Tamnbah Data
      </button>


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
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Nilai UTS</th>
                            <th>Nilai UAS</th>
                            <th>Nilai Tugas</th>
                            <th>Nilai UH</th>
                            <th>Nilai Raport</th>
                            <th>Nilai Keterampilan</th>
                            <th>Nilai Sikap</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $jadwalmapel)
                        <tr>
                          
                            <td>{{ $jadwalmapel->nik }}</td>
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->nilai_uts}}</td>
                            <td>{{ $jadwalmapel->nilai_uas}}</td>
                            <td>{{ $jadwalmapel->nilai_tugas}}</td>
                            <td>{{ $jadwalmapel->nilai_uh}}</td>
                            <td>{{ $jadwalmapel->nilai_raport}}</td>
                            <td>{{ $jadwalmapel->nilai_keterampilan}}</td>
                            <td>{{ $jadwalmapel->sikap}}</td>
                            <td>
                               
                                {{-- <button type="button" class="btn btn-warning border-0" data-toggle="modal" data-target="#edit{{$jadwalmapel->id}}">
                                    <i class="fas fa-pen "></i>
                                  </button> --}}
                                  <a class="btn btn-warning  border-0" href="/nilai/{{$jadwalmapel->id}}/edit"> <i class="fas fa-pen "></i></a>
                                <form method="post" action="/nilai/{{$jadwalmapel->id}}" class="d-inline ">
                                    @method('delete')
                                    @csrf
                                    {{-- <input type="text" value="$"> --}}
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/nilai/">
            <div class="modal-body">
                @csrf
                
                <div class="form-group">
                    <label for="jk">Nama Peserta Didik</label>
                    <select class="form-control" name="siswa_id" id="nip" required>
                        {{-- <option selected> Silahkan Pilih Nama Siswa</option> --}}
                        @foreach($siswa as $key => $sw)
                        @php
                            $absenData = $siswanilai[$key]->first();
                        @endphp
                        @if ($absenData=== null)  
                        <option value="{{ $sw->id }}">{{ $sw->nik }} / {{ $sw->nama }}</option>
                        @else
                        @if ($sw->id === $absenData->siswa_id)   
                        @else
                        <option value="{{ $sw->id }}">{{ $sw->nik }} / {{ $sw->nama }}</option>
                        @endif
                        
                        @endif
                         @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="nohp">Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel" value="{{ $mapels->mapel }}" disabled readonly >
                    @error('mapel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jam Pelajaran</label>
                    <input type="text" name="sks" class="form-control" id="sks" value="{{ $mapels->sks }}"   readonly>
                    
                </div> 
                <div class="form-group">
                    <input type="hidden" name="jadmapel_id" class="form-control"  value="{{ $mapels->mapel_id }}">
                    <input type="hidden" name="kelas_id" class="form-control"  value="{{ $mapels->kelas }}">
                    <input type="hidden" name="thnakademik_id" class="form-control"  value="{{ $mapels->thunakademik_id }}">
                </div> 
                <div class="form-group">
                    <input type="hidden" name="slug" class="form-control" value="{{ $mapels->slug}}"  >
                
                    <input type="hidden" name="semester" class="form-control" value="{{ $mapels->semester }}">
                    <input type="hidden" name="guru_id" class="form-control" value="{{ $mapels->guru_id }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai UTS</label>
                    <input type="text" name="nilai_uts" class="form-control" id="nilai"  >
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
  @foreach($jadwalmapels as $jadwalmapel)
<div class="modal fade" id="edit{{$jadwalmapel->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/nilai/{{$jadwalmapel->id}}">
                <div class="modal-body">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="jk">Nik</label>
                        <select class="form-control" name="siswa_id" id="nip" disabled>
                            <option value="{{ $jadwalmapel->siswa_id }}" selected readonly>{{ $jadwalmapel->nik }} / {{ $jadwalmapel->nama }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nohp">Mata Pelajaran</label>
                        <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel" value="{{ $jadwalmapel->mapel }}" disabled readonly >
                        @error('mapel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam Pelajaran</label>
                        <input type="text" name="sks" class="form-control" id="sks" value="{{$jadwalmapel->sks}}"  disabled readonly>
                    </div> 
                    <div class="form-group">
                        <input type="hidden" name="slug" class="form-control"  value="{{ $jadwalmapel->slug }}">
                    </div> 
                    <div class="form-group">
                    </div> 
                    <div class="form-group">
                        <input type="hidden" name="jadmapel_id" class="form-control"  value="{{ $jadwalmapel->jadmapel_id}}">
                    </div> 
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai UTS </label>
                        <input type="text" name="nilai_uts" class="form-control"  id="nilai_uts"     value="{{$jadwalmapel->nilai_uts}}"  >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai UAS </label>
                        <input type="text" name="nilai_uas" class="form-control" id="nilai_uas" value="{{$jadwalmapel->nilai_uas}}" >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rata - Rata Nilai Tugas </label>
                        <input type="text" name="nilai_tugas" class="form-control" id="nilai_tugas" value="{{$jadwalmapel->nilai_tugas}}" >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rata - Rata Nilai UH </label>
                        <input type="text" name="nilai_uh" class="form-control" id="nilai_uh"  value="{{$jadwalmapel->nilai_uh}}" >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai Raport </label>
                        <input type="text" name="nilai_raport" class="form-control" id="result" value="{{$jadwalmapel->nilai_raport}}" >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai Keterampilan </label>
                        <input type="text" name="nilai_keterampilan" class="form-control" value="{{$jadwalmapel->nilai_keterampilan}}"   >
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai Sikap </label>
                        <input type="text" name="sikap" class="form-control" value="{{$jadwalmapel->sikap}}"   >
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nilai_uts = document.getElementById('nilai_uts');
        const nilai_uas = document.getElementById('nilai_uas');
        const nilai_tugas = document.getElementById('nilai_tugas');
        const nilai_uh = document.getElementById('nilai_uh');
      
        const resultInput = document.getElementById('result');

 
        nilai_uts.addEventListener('input', updateResult);
        nilai_uas.addEventListener('input', updateResult);
        nilai_tugas.addEventListener('input', updateResult);
        nilai_uh.addEventListener('input', updateResult);

        function updateResult() {
            // Ambil nilai input
            const value1 = parseFloat(nilai_uts.value) || 0;
            const value2 = parseFloat(nilai_uas.value) || 0;
            const value3 = parseFloat(nilai_tugas.value) || 0;
            const value4 = parseFloat(nilai_uh.value) || 0;

            // Lakukan penjumlahan
            const result = (value1 + value2 + (value3 * 2 ) + value4 ) / 5 ;

            // Tampilkan hasil
            resultInput.value = result;
            // resultDiv.innerText = 'Hasil: ' + result;
        }
    });
</script>

  {{-- </div> --}}

@endsection