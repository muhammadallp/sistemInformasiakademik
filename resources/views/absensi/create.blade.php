@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/guru/">
                    @csrf
                    <div class="form-group">
                        <label for="jk">Nik</label>
                        <select class="form-control" name="user_id" id="nip">
                            <option selected disabled> Silahkan Pilih Guru</option>
                            @foreach($users as $user)
                            @if(old('guru')==$user->id)
                            <option value="{{ $user->id }}" selected>{{ $user->nik }} / {{ $user->nama }}</option>
                            @else
                            <option value="{{ $user->id }}">{{ $user->nik }} / {{ $user->nama }}</option>
                            @endif
                             @endforeach
                        </select>
                      </div>
                    {{-- <div class="form-group">
                    <label for="nip">Nomor Induk Pegawai</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" autofocus value="{{ old('nip') }}">
                    @error('nip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    </div> --}}
                    
                    <div class="form-group">
                        <label for="nohp">Nomor HandPone</label>
                        <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" id="nohp" value="{{ old('nohp') }}" >
                        @error('nohp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" disabled readonly >
                    </div> 
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option selected disabled> Silahkan Pilih Jenis Kelamin</option>
                            <option value="laki-laki" >Laki Laki</option>
                            <option value="perempuan" >Perempuan</option>
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>    
            </div>
        </div>
    </div>
</div>
<script>
    const nohp = document.querySelector('#nohp');
    const slug = document.querySelector('#slug');

    nohp.addEventListener('change', function(){
        fetch('/siswa/posts/checkSlug?nohp=' + nohp.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection