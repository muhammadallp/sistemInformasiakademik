<?php $session = session(); ?>
<body onLoad="javascript:print()"> 


                            <div class="panel-heading">
                            <table width="100%">
							<tr>
							<td><div align="center">
							<div align="center">
                                <b>SEKOLAH MENENGAH PERTAMA NEGERI 1 SIPORA SELATAN<br>JL. Pastoran Sioban, Kecamatan Sipora Selatan</b><br><hr><br>Laporan Data Guru<br> Tahun  : <?= $tahun ?></div>
							 </td>
							</tr>
							</table>
                    </div>
                    <br>
                    <table id='theList' border=1 width='100%' class='table table-bordered table-striped' cellspacing="0">

                            <tr>
                                <th>Nomor Induk Pegawai</th>
                                <th>Nama Guru</th>
                                <th>Jenis Kelamin</th>
                                <th>NoHp</th>
                                <th>tanggal</th>
                            </tr>

                            @foreach($gurus as $kr)
                            <tr>
                                <td>{{ $kr->nik }}</td>
                                <td>{{ $kr->nama }}</td>
                                <td>{{ $kr->jk }}</td>
                                <td>{{ $kr->nohp }}</td>
                                <td>{{date('d F Y', strtotime($kr->created_at))  }}</td>
                            </tr>
                            @endforeach

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