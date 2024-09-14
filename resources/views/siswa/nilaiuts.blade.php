@extends('layouts.main')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Data NIlai UTS</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h6 class="m-0 font-weight-bold text-primary mb-3">DataTables Siswa</h6> --}}
            <a href="/laporan-nilai" class="btn btn-primary btn-sm ">Print PDF</a>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @foreach ($semester as $sm)
                <table class="table table-bordered" width="100%" cellspacing="0" hight="30%">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="6" >Kelas : {{ $sm->kelas_id }} </th>
                            <tr>
                                <td class="text-center" colspan="6" >Semester : {{ $sm->semester }} </td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Guru</th>
                                <th>Jam Pelajaran</th>
                                <th>KBM</th>
                                <th>Grade</th>
                                <th>Bobot</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $sw)
                        @if ($sw->semester === $sm->semester && $sw->kelas_id === $sm->kelas_id)
                        <tr>
                            <td>{{ $sw->mapel }}</td>
                            <td>{{ $sw->nama }}</td>
                            {{-- <td>{{ $sw->sks }}</td> --}}
                            <td>{{ $sw->kbm }}</td>
                            <td>
                                @if($sw->nilai_uts > 89 && $sw->nilai_uts <=100  )
                                {{ "A" }}
                               @endif
                               @if($sw->nilai_uts > 79 && $sw->nilai_uts <= 89  )
                                {{ "B" }}
                               @endif
                               @if($sw->nilai_uts > 69 && $sw->nilai_uts <= 79  )
                                {{ "C" }}
                               @endif
                               @if($sw->nilai_uts > 59 && $sw->nilai_uts <= 69  )
                                {{ "D" }}
                               @endif
                               @if($sw->nilai_uts  <= 59  )
                                {{ "E" }}
                               @endif
                            </td>
                            <td>{{ $sw->nilai_uts }}</td>
                        </tr>
                        @endif
                        @endforeach
                        <tr>
                            <td colspan="2"  class="text-right" >Jumlah Jam Pelajaran : </td>
                            @foreach($totalsks as $t)
                            @if ($sm->semester === $t->semester)
                            <td >{{ $t->total_sks }}</td>
                            @endif
                            @endforeach
                           <td colspan="3"></td> 
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="text-right">Rata-Rata Nilai : </td>
                            @foreach($ipk as $t)
                            @foreach($totalmapel as $tm)
                            @if ($sm->semester === $t->semester && $sm->semester === $tm->semester)
                            @php
                                $nilairatarata = $t->ratanilai/$tm->ratanilai;
                                $hasil = number_format($nilairatarata, 2, ',', '.')
                            @endphp
                            {{-- <td >{{ $t->ratanilai }} / {{ $tm->ratanilai }} = {{ $t->ratanilai / $tm->ratanilai }}</td> --}}
                            <td >{{ $hasil }}</td>
                            @endif
                            @endforeach
                            @endforeach
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection