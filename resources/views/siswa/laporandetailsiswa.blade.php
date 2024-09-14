<div class="container-fluid px-4">
    <!-- <h1 class="mt-4">Tables</h1> -->
    <form action="/viewpdf" method="GET" class="mb-3">
    <input type="hidden" name="year" id="year" value="{{ $year }}">
    <button type="submit" id="tampil" class="btn btn-primary mb-3">Print PDF</button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user fa-fw"></i>
           Data Siswa
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>NoHp</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                @foreach($results as $kr)
                                <tr>
                                    <td>{{ $kr->nik }}</td>
                                    <td>{{ $kr->nama }}</td>
                                    <td>{{ $kr->jk }}</td>
                                    <td>{{ $kr->nohp }}</td>
                                    <td>{{ $kr->alamat }}</td>
                                    <td>{{ $kr->kelas }}</td>
                                  
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>