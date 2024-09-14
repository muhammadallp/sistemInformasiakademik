@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <style>
        button[type="submit"] {
    background-color: transparent;
    border: none;
    padding: 0;
    margin-right: 60px;
}

button[type="submit"]:focus {
    outline: none;
}
    </style>
    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Absensi Siswa Kelas {{ $mapels->kelas }} Mata Pelajaran : {{ $mapels->mapel }}</h1>
    {{-- <a href="/nilai/create" class="btn btn-primary mb-3">Tambah Data</a> --}}

 
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th colspan="3" class="text-center" >Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa as $key => $sw)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sw->nik }}</td>
                                <td>{{ $sw->nama }}</td>
                                @if ($absensi[$key]->isEmpty())
                                <td>
                                <form method="post" action="/absensi/">
                                    @csrf
                                <button type="submit">
                                <div class="form-check">
                                        <input type="hidden" name="id_guru" id="" value="{{ $guru }}">
                                        <input type="hidden" name="id_siswa" id="" value="{{ $sw->id }}">
                                        <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                        <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                        <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">
                                        <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckDefault_{{ $sw->id }}">
                                        <label class="form-check-label" for="flexCheckDefault_{{ $sw->id }}">
                                            Hadir
                                        </label>

                                    </div>
                                </button>
                            </td>
                            <td>
                                <button type="submit">
                                    <div class="form-check">
                                        <input type="hidden" name="id_guru" id="" value="{{ $guru }}">
                                        <input type="hidden" name="id_siswa" id="" value="{{ $sw->id }}">
                                        <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                        <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                        <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">
                                        <input class="form-check-input" name="status" type="checkbox" value="2" id="flexCheckChecke_{{ $sw->id }}">
                                        <label class="form-check-label" for="flexCheckChecke_{{ $sw->id }}">
                                            Izin
                                        </label>
                                    </div>
                                </button>
                            </td>
                            <td>
                                <button type="submit">
                                    <div class="form-check">
                                        <input type="hidden" name="id_guru" id="" value="{{ $guru }}">
                                        <input type="hidden" name="id_siswa" id="" value="{{ $sw->id }}">
                                        <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                        <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                        <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">
                                        <input class="form-check-input" name="status" type="checkbox" value="3" id="flexCheckChecked_{{ $sw->id }}">
                                        <label class="form-check-label" for="flexCheckChecked_{{ $sw->id }}">
                                            Tanpa Keterangan
                                        </label>
                                    </div>
                                </button>
                            </form>
                        </td>
                        {{-- </tr> --}}
                                @else
                                {{-- <tr> --}}
                                <td>
                                    <form method="post" action="/absensi/{{ $absensi[$key]->first()->id }}">
                                        @method('put')
                                        @csrf
                                        <button type="submit">
                                        <div class="form-check">
                                            <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                            <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                            <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">   
                                        <input class="form-check-input" type="checkbox" name="status" value="1" id="flexCheckDefault_{{ $sw->id }}" {{ $absensi[$key]->isEmpty() ? '' : ($absensi[$key]->first()->status === 1 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="flexCheckDefault_{{ $sw->id }}">
                                            Hadir
                                        </label>
                                    </div>
                                    </button>
                                </td>
                                <td>
                                    <button type="submit">
                                    <div class="form-check">
                                        <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                        <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                        <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">
                                        <input class="form-check-input" type="checkbox"  name="status" value="2" id="flexCheckChecke_{{ $sw->id }}" {{ $absensi[$key]->isEmpty() ? '' : ($absensi[$key]->first()->status === 2 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="flexCheckChecke_{{ $sw->id }}">
                                            Izin
                                        </label>
                                    </div>
                                    </button>
                                </td>
                                <td>
                                    <button type="submit">
                                    <div class="form-check">
                                        <input type="hidden" name="slug" id="" value="{{ $idjadmapel }}">
                                        <input type="hidden" name="id_jadmapel" id="" value="{{ $mapels->id }}">
                                        <input type="hidden" name="id_pertemuan" id="" value="{{ $pertemuan}}">
                                        <input class="form-check-input" type="checkbox" name="status" value="3" id="flexCheckChecked_{{ $sw->id }}" {{ $absensi[$key]->isEmpty() ? '' : ($absensi[$key]->first()->status === 3 ? 'checked' : '') }}>
                                        <label class="form-check-label" for="flexCheckChecked_{{ $sw->id }}">
                                            Tanpa Keterangan
                                        </label>
                                    </div>
                                </button>
                            </form>
                            </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                
                
            </div>

        </div>
    </div>

</div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});



</script>
  {{-- </div> --}}

@endsection