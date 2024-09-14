@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/jadwalmapel/{{ $jadwalmapel->slug }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="thunakademik_id">Tahun Akademik</label>
                        <select class="form-control" name="thunakademik_id" id="thunakademik_id" readonly>
                            <option value="{{ $tahunakademik->id }}" selected >{{ $tahunakademik->tahun }}</option>
                        </select>
                      </div>

                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select class="form-control" name="hari" id="mapel">
                            {{-- <option valu    >{{$jadwalmapel->hari}}</option> --}}
                            <option value="{{ $jadwalmapel->hari }}" selected>{{$jadwalmapel->hari}}</option>
                            <option value="senin" >Senin</option>
                            <option value="selasa" >selasa</option>
                            <option value="rabu" >Rabu</option>
                            <option value="kamis" >kamis</option>
                            <option value="jumat" >Jumat</option>
                            <option value="sabtu" >Sabtu</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="mapel_id">Mata Pelajaran</label>
                        <select class="form-control" name="mapel_id" id="mapel">
                            <option value="{{ $mapell->id }}" selected > {{ $mapell->mapel }}</option>
                            @foreach($mapels as $mapel)
                            @if(old('mapel_id')==$mapel->id)
                            <option value="{{ $mapel->id }}" selected>{{ $mapel->mapel }}</option>
                            @else
                            <option value="{{ $mapel->id }}">{{ $mapel->mapel }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-control" name="kelas_id" id="mapel">
                            <option value="{{ $kelass->id }}" selected > {{ $kelass->kelas }}</option>
                            @foreach($kelas as $kls)
                            @if(old('kelas_id')==$kls->id)
                            <option value="{{ $kls->id }}" selected>{{ $kls->kelas }}</option>
                            @else
                            <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jk">Guru</label>
                        <select class="form-control" name="guru_id" id="mapel">
                            <option value="{{ $gurus->id }}" selected>{{ $gurus->nama }}</option>
                            @foreach($guru as $guru)
                            @if(old('guru')==$guru->id)
                            <option value="{{ $guru->id }}" selected>{{ $guru->nama }}</option>
                            @else
                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="semester">Semeter</label>
                        <input type="text" name="semester" class="form-control @error('semester') is-invalid @enderror" id="semester" value="{{ $jadwalmapel->semester }}">
                        @error('semester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" disabled readonly  value="{{ $jadwalmapel->slug }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jam Pelajaran</label>
                            <input type="text" name="sks" class="form-control" id="sks" value="{{ $jadwalmapel->sks }}" >
                        </div>
                        <div class="form-group">
                            <label for="jam_masuk">Jam Masuk</label>
                            <input type="time" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror" id="jam_masuk" value="{{ $jadwalmapel->jam_masuk }}" >
                            @error('jam_masuk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <div class="form-group">
                        <label for="jam_keluar">Jam Keluar</label>
                        <input type="time" name="jam_keluar" class="form-control @error('jam_keluar') is-invalid @enderror" id="jam_keluar" value="{{ $jadwalmapel->jam_keluar }}" >
                        @error('jam_keluar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> 
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </form>  
            </div>
        </div>
    </div>
</div>
<script>
    const semester = document.querySelector('#semester');
    const slug = document.querySelector('#slug');

    semester.addEventListener('change', function(){
        fetch('/jadwalmapel/posts/checkSlug?semester=' + semester.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection