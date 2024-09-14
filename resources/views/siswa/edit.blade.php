@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/siswa/{{ $siswa->slug }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Nomor Induk Siswa</label>
                        <select class="form-control" name="user_id" id="nip">
                            <option  value="{{ $siswas->user_id }}" selected >{{ $siswas->nik }} / {{ $siswas->nama }}</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nik }} / {{ $user->nama }}</option>
                             @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="nohp">Nomor HandPone</label>
                        <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" id="nohp" value="{{ $siswa->nohp }}" >
                        @error('nohp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $siswa->slug }}" disabled readonly >
                    </div> 
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ $siswa->alamat }}" >
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jk">Kelas</label>
                        <select class="form-control" name="kelas_id" id="kelas_id">
                            <option selected value="{{ $kelassiswa->id }}"> {{ $kelassiswa->kelas }}</option>
                            @foreach($kelas as $kls)
                          
                            <option value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                         
                             @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jk">Tahun Akademik</label>
                        <select class="form-control" name="thnakademik_id" id="nip">
                            <option selected value="{{ $thnakademik->id }}" > {{ $thnakademik->tahun }}</option>
                            @foreach($tahunakademiks as $tahunakademik)
                          
                            <option value="{{ $tahunakademik->id }}">{{ $tahunakademik->tahun }}</option>
                         
                             @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option selected value="{{ $siswa->jk }}">{{ $siswa->jk }}</option>
                            <option value="laki-laki" >Laki Laki</option>
                            <option value="perempuan" >Perempuan</option>
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
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