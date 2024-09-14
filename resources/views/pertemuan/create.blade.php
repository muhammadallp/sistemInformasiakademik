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
            
            <form method="post" action="/pertemuan/">
                @csrf
                <div class="form-group">
                  <label for="pertemuan">Pertemuan</label>
                  <input type="text" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" autofocus value="{{ old('keterangan') }}">
                  @error('keterangan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" autofocus value="{{ old('tanggal') }}">
                  @error('tanggal')
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
@endsection