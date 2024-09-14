<?php $session = session(); ?>
<body onLoad="javascript:print()"> 
                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>SEKOLAH MENENGAH PERTAMA NEGERI 1 SIPORA SELATAN<br>JL. Pastoran Sioban, Kecamatan Sipora Selatan</b><br><hr><br>Daftar Matapelajaran </div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">
                            <thead>
                                <tr>
                             <th>No</th>
                            <th>Hari</th>
                            <th>Mata Pelajaran</th>
                            <th>Semeter</th>
                            <th>Kelas</th>
                            <th>Guru</th>
                            <th>SKS</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwalmapels as $jadwalmapel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwalmapel->hari }}</td>
                            <td>{{ $jadwalmapel->mapel }}</td>
                            <td>{{ $jadwalmapel->semester }}</td>
                            <td>{{ $jadwalmapel->kelas }}</td>
                            <td>{{ $jadwalmapel->nama }}</td>
                            <td>{{ $jadwalmapel->sks }}</td>
                            <td>{{ $jadwalmapel->jam_masuk }}</td>
                            <td>{{ $jadwalmapel->jam_keluar }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                      
                    <br>
                    <br>
                    <br>
                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" >
                    <tr>
                        <td width="80%" bgcolor="#FFFFFF">
                            <p align="center"></p><br/>
                        </td>
                         <td width="50%" bgcolor="#FFFFFF">
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