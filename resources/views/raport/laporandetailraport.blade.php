<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/vieraport" method="GET" class="mb-3">
    <input type="hidden" name="year" id="year" value="{{ $year }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user fa-fw"></i>
           Nilai Raport
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>KBM</th>
                                <th>Angka</th>
                                <th>Predikat</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                <tr>
                                    <td colspan="6">Kelompok : A </td>
                                </tr>
                                @foreach($resulst as $kr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kr->mapel }}</td>
                                    <td>{{ $kr->kbm }}</td>
                                    <td>{{ $kr->nilai_raport }}</td>
                                    <td>
                                        @if($kr->nilai_raport > 89 && $kr->nilai_raport <=100  )
                                         {{ "A" }}
                                        @endif
                                        @if($kr->nilai_raport > 80 && $kr->nilai_raport <= 89  )
                                         {{ "B" }}
                                        @endif
                                        @if($kr->nilai_raport > 69 && $kr->nilai_raport <= 79  )
                                         {{ "C" }}
                                        @endif
                                        @if($kr->nilai_raport > 59 && $kr->nilai_raport <= 69  )
                                         {{ "D" }}
                                        @endif
                                        @if($kr->nilai_raport  <= 59  )
                                         {{ "E" }}
                                        @endif
                                    </td>
                                    <td>{{ $kr->deskripsi }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">Kelompok : B </td>
                                </tr>
                                @foreach($resulst1 as $kr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kr->mapel }}</td>
                                    <td>{{ $kr->kbm }}</td>
                                    <td>{{ $kr->nilai_raport }}</td>
                                    <td>
                                        @if($kr->nilai_raport > 89 && $kr->nilai_raport <=100  )
                                         {{ "A" }}
                                        @endif
                                        @if($kr->nilai_raport > 80 && $kr->nilai_raport <= 89  )
                                         {{ "B" }}
                                        @endif
                                        @if($kr->nilai_raport > 69 && $kr->nilai_raport <= 79  )
                                         {{ "C" }}
                                        @endif
                                        @if($kr->nilai_raport > 59 && $kr->nilai_raport <= 69  )
                                         {{ "D" }}
                                        @endif
                                        @if($kr->nilai_raport  <= 59  )
                                         {{ "E" }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>