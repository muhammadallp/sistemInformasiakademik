@extends('layouts.main')
@section('container')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
            </div>
            <div class="card-body">
                
                <form method="post" action="/mapel/">
                    @csrf
                    <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror" id="mapel" autofocus value="{{ old('mapel') }}">
                    @error('mapel')
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
                        <label for="exampleInputEmail1">KBM</label>
                        <input type="number" name="kbm" class="form-control"   >
                    </div>
                    <div class="form-group">
                        <label for="kelompok">Kelompok</label>
                        <input type="text" name="kelompok" class="form-control @error('kelompok') is-invalid @enderror" id="kelompok" autofocus value="{{ old('kelompok') }}">
                        @error('kelompok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>  
            </div>
        </div>
    </div>
</div>
<script>
    const mapel = document.querySelector('#mapel');
    const slug = document.querySelector('#slug');

    mapel.addEventListener('change', function(){
        fetch('/mapel/posts/checkSlug?mapel=' + mapel.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection