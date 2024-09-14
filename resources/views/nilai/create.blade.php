@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <div class="card-body">
                
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
                    
                {{-- </div> --}}
                    
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </form>    
            </div>
        </div>
    </div>
</div>

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
@endsection