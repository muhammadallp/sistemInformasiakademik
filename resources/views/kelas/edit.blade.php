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
            <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
        </div>
        <div class="card-body">
            
            <form method="post" action="/kelas/{{ $kelas->slug }}">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="kelas">Kelas</label>
                  <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" autofocus value="{{ old('kelas',$kelas->kelas) }}">
                  @error('kelas')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $kelas->slug }}" disabled readonly >
                    
                  </div>
                <button type="submit" class="btn btn-primary">Edit Data</button>
              </form>  
        </div>
    </div>

</div>
</div>
<script>
    const kelas = document.querySelector('#kelas');
    const slug = document.querySelector('#slug');

    kelas.addEventListener('change', function(){
        fetch('/kelas/checkSlug?kelas=' + kelas.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection