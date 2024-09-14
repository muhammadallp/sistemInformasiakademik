@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/guru/{{ $guru->slug }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="jk">Nik</label>
                        <select class="form-control" name="user_id" id="nip">
                            <option value="{{ $gurus->id }}" selected >{{ $gurus->nik }} / {{ $gurus->nama }} </option>
                            @foreach($users as $user)
                           
                            <option value="{{ $user->id }}">{{ $user->nik }} / {{ $user->nama }}</option>
                             @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                        <label for="nohp">Nomor HandPone</label>
                        <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" id="nohp" value="{{ $guru->nohp }}" >
                        @error('nohp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{ $guru->slug }}" disabled readonly >
                    </div> 
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" name="jk" id="jk">
                            <option alue="{{ $guru->jk }}" selected disabled> {{ $guru->jk }}</option>
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