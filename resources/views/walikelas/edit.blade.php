@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/walikelas/{{ $walikelas->id }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nip">Nama Guru</label>
                        <select class="form-control" name="guru_id" id="nip">
                            <option selected value="{{ $walikelas->guru_id }}" >{{ $walikelas->nik }} / {{ $walikelas->nama }}</option>
                            @foreach($guru as $user)
                            @if(old('guru_id')==$user->id)
                            <option value="{{ $user->id }}" selected>{{ $user->id }} / {{ $user->nama }}</option>
                            @else
                            <option value="{{ $user->id }}">{{ $user->nik }} / {{ $user->nama }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas">
                            <option selected value="{{ $walikelas->kelas_id }}" >{{ $walikelas->kelas }} </option>
                            @foreach($kelas as $kls)
                            @if(old('kelas_id')==$kls->id)
                            <option value="{{ $kls->id }}" selected>{{ $kls->kelas }} </option>
                            @else
                            <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </form>  
            </div>
        </div>
    </div>
</div>

@endsection