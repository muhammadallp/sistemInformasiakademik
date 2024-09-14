@extends('layouts.main')
@section('container')
<div class="container-fluid">
    <!-- Page Heading -->
   

    {{-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
        </div>
        <div class="card-body">
            
            <form method="post" action="/tahunakademik/{{ $tahunakademik->slug }}">
                {{-- <form method="post" action="/kelas/{{ $kelas->slug }}"> --}}
                    @method('put')
                @csrf
                <div class="form-group">
                  <label for="kelas">Tahun Akademik</label>
                  <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" id="tahun" autofocus value="{{ $tahunakademik->tahun}}">
                  @error('kelas')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" disabled readonly  value="{{ $tahunakademik->slug }}">
                    
                  </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
              </form>  
        </div>
    </div>

</div>
</div>
<script>
    const tahun = document.querySelector('#tahun');
    const slug = document.querySelector('#slug');

    tahun.addEventListener('change', function(){
        fetch('/tahunakademik/posts/checkSlug?tahun=' + tahun.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection