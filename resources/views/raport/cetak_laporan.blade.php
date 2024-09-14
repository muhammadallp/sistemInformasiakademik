<?php $session = session(); ?>
<body onLoad="javascript:print()"> 


                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>SEKOLAH MENENGAH PERTAMA NEGERI 1 SIPORA SELATAN<br>JL. Pastoran Sioban, Kecamatan Sipora Selatan</b><br><hr><br></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <table width='100%'>
                        <tr>
                            <th align="left">
                                Nama Sekolah
                            </th>
                            <th>
                                :
                            </th>
                            <td>SMPN 1 Sipora</td>
                            <th align="right">
                                Kelas
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ $siswa->kelas_id}}</td>
                        </tr>
                        <tr>
                            
                            <th align="left">
                                Nama Peserta DIdik
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ auth()->user()->nama }}</td>

                            <th align="right">
                                Semester
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ $siswa->semester}}</td>
                        </tr>
                        <tr>
                            <th align="left">
                                NIS / NISN
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ auth()->user()->nik }}</td>
                            <th align="right">
                                Tahun Pelajaran
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ $siswa->tahun}}</td>
                        </tr>
                       
                    </table>
                    <br><br>
                    <div align="center">
                    <b align="center" >CAPAIAN HASSIL BELAJAR</b>
                    </div>
                    <p><b>A. NILAI SIKAP</b></p>
                   <p><b>1. Sikap Spritual</b></p> 
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
                        <tr>
                            <th>Huruf</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                        </tr>
                        <tr>
                            <td align="center" >
                                {{ $sikap->sikap }}
                            </td>
                            <td>
                        
                           @if ($sikap->sikap =='A')
                           Sangat Baik
        
                               @elseif($sikap->sikap =='B')
                               Baik
                               @else
                               Kurang Baik
                               @endif
                            </td>
                            <td>Siswa Selalu menghargai dan menghayati agama yang di anutnya dengan baik</td>
                        </tr>
                    </table>
                    <br>
                   <p><b>2. Sikap Sosial</b></p>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
                        <tr>
                            <th>Huruf</th>
                            <th>Predikat</th>
                            <th>Deskripsi</th>
                        </tr>
                        <tr>
                            <td align="center" >
                                {{ $sikap->sikap }}
                            </td>
                            <td>
                        
                           @if ($sikap->sikap =='A')
                           Sangat Baik
        
                               @elseif($sikap->sikap =='B')
                               Baik
                               @else
                               Kurang Baik
                               @endif
                            </td>
                            <td>Siswa Berinteraksi sosial dengan baik ditengah masyarakat dan sopan dalam berbicara</td>
                        </tr>
                    </table>
                    <br>
                    {{-- <br><hr><br><b>Capaian Hasil Belajar</b><br> --}}
                    <p><b>B. NILAI PENGETAHUAN</b></p>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

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
                                <td>{{ $kr->deskripsi }}</td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                <br>
                    <p><b>C. NILAI KETERAMPILAN</b></p>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

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
                                <td>{{ $kr->nilai_keterampilan }}</td>
                                <td>
                                    @if($kr->nilai_keterampilan > 89 && $kr->nilai_keterampilan <=100  )
                                     {{ "A" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 79 && $kr->nilai_keterampilan <= 89  )
                                     {{ "B" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 69 && $kr->nilai_keterampilan <= 79  )
                                     {{ "C" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 59 && $kr->nilai_keterampilan <= 69  )
                                     {{ "D" }}
                                    @endif
                                    @if($kr->nilai_keterampilan  <= 59  )
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
                                <td>{{ $kr->nilai_keterampilan }}</td>
                                <td>
                                @if($kr->nilai_keterampilan > 89 && $kr->nilai_keterampilan <=100  )
                                     {{ "A" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 79 && $kr->nilai_keterampilan <= 89  )
                                     {{ "B" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 69 && $kr->nilai_keterampilan <= 79  )
                                     {{ "C" }}
                                    @endif
                                    @if($kr->nilai_keterampilan > 59 && $kr->nilai_keterampilan <= 69  )
                                     {{ "D" }}
                                    @endif
                                    @if($kr->nilai_keterampilan  <= 59  )
                                     {{ "E" }}
                                    @endif
                                </td>
                                <td>{{ $kr->deskripsi }}</td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                    <br>
                    <p><b>E. kETIDAK HADIRAN</b></p>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
                        <tr>
                            <td>Hadir</td>
                            <td> {{ $totalhadir->totalhadir }} hari</td>
                        </tr>
                        <tr>
                            <td>Izin</td>
                            <td> {{ $totalizin->totalizin }} hari</td>
                        </tr>
                        <tr>
                            <td>Tanpa Keterangan</td>
                            <td> {{ $totalalfa->totalalfa }} hari</td>
                        </tr>
                </table>
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" >
                        <tr>
                            <td width="80%" bgcolor="#FFFFFF">
                                <p align="center"></p><br/>
                            </td>
                             <td width="60%" bgcolor="#FFFFFF">
                                 <div align="center">SMPN 1 Sipora Selatan <?= Date('d F Y'); ?><br/>
                                walikelas,
                                <br/><br/>
                                <br/><br/>
                                {{ $walikelas->nama }}
                                <br>
                                NIGK.{{$walikelas->nik }}
                                
                                <br/>
                                </div>
                            </td>
                        </tr>
                        </table> 