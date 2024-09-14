<?php $session = session(); ?>
<body onLoad="javascript:print()"> 
                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>SEKOLAH MENENGAH PERTAMA NEGERI 1 SIPORA SELATAN<br>JL. Pastoran Sioban, Kecamatan Sipora Selatan</b><br><hr><br>Laporan Nilai UAS <br><?= Date('d F Y'); ?></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>

                    <table  width="100%">
                        <tr>
                            <th align="left">
                                Nama Sekolah
                            </th>
                            <th>
                                :
                            </th>
                            <td>SMP Negeri 1 Sipora </td>
                            
                            <th align="right">
                           
                                Nama Peserta DIdik
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ auth()->user()->nama }}</td>
                        </tr>
                        <tr>
                            <th align="left">
                                Alamat
                            </th>
                            <th>
                                :
                            </th>
                            <td>Jl. Pastoran Sioban</td>

                           <th align="right">
                                NIS / NISN
                            </th>
                            <th>
                                :
                            </th>
                            <td>{{ auth()->user()->nik }}</td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <div class="table-responsive">
                        @foreach ($semester as $sm)
                        <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
                            <thead>
                                <tr>
                                    <th align="center" colspan="6" >Kelas : {{ $sm->kelas_id }} </th>
                                    <tr>
                                        <td align="center" colspan="6" >Semester : {{ $sm->semester }} </td>
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
                                    <td>{{ $sw->sks }}</td>
                                    <td>{{ $sw->kbm }}</td>
                                    <td>
                                        @if($sw->nilai_uas > 89 && $sw->nilai_uas <=100  )
                                         {{ "A" }}
                                        @endif
                                        @if($sw->nilai_uas > 80 && $sw->nilai_uas <= 89  )
                                         {{ "B" }}
                                        @endif
                                        @if($sw->nilai_uas > 69 && $sw->nilai_uas <= 79  )
                                         {{ "C" }}
                                        @endif
                                        @if($sw->nilai_uas > 59 && $sw->nilai_uas <= 69  )
                                         {{ "D" }}
                                        @endif
                                        @if($sw->nilai_uas  <= 59  )
                                         {{ "E" }}
                                        @endif
                                    </td>
                                    <td>{{ $sw->nilai_uas }}</td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td colspan="2"  align="right" >Jumlah Jam Pelajaran : </td>
                                    @foreach($totalsks as $t)
                                    @if ($sm->semester === $t->semester)
                                    <td >{{ $t->total_sks }}</td>
                                    @endif
                                    @endforeach
                                   <td colspan="3"></td> 
                                </tr>
                                
                                <tr>
                                    <td colspan="2" align="right" >Rata-Rata Nilai : </td>
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
                            Kepala Sekolah SMPN 1 Sipora Selatan
                            <br/><br/>
                            <br/><br/>
                            {{ $session->get('namapegawai'); }}
                     
                            <br>
                            <?= $session->get('nip'); ?>
                            
                            <br/>
                            </div>
                        </td>
                    </tr>
                    </table> 