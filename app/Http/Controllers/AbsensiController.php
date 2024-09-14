<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\guru;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user()->id;
        $users= guru::where('user_id',$user)->first();
        $guru=$users->id;
        $kelas =  DB::table('jadwalmapels')
        // ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
        // ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        // ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
        // ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('jadwalmapels.kelas_id')
        ->where('jadwalmapels.guru_id',$guru)
        // ->where('jadwalmapels.mapel_id',$a->mapel_id)
        ->get();
        // dd($kelas);
       
        $jadwalmapel = DB::table('jadwalmapels')
        ->select('kelas_id', DB::raw('COUNT(jadwalmapels.id) as total_jadwal')) // Menggunakan COUNT() untuk menghitung jumlah baris
        ->where('jadwalmapels.guru_id', $guru)
        ->groupBy('kelas_id') // Group by kelas
        ->get();

        foreach ( $jadwalmapel as $a):
            $mapel[]= DB::table('jadwalmapels')
                ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
                ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
                ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
                ->join('users', 'gurus.user_id', '=', 'users.id')
                ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik')
                ->where('jadwalmapels.guru_id',$guru)
                ->where('jadwalmapels.kelas_id',$a->kelas_id)
                ->first();
        endforeach;
        // dd($mapel);
    //   $jadwalmapels = DB::table('jadwalmapels')
    //     ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
    //         ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
    //         ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
    //         ->join('users', 'gurus.user_id', '=', 'users.id')
    //         ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik')
    //         ->where('jadwalmapels.guru_id',$guru)
    //         ->get();

        return view('absensi.index',[
            'title' => 'Absen Siswa | SMPN 1 Sipora',
            'jadwalmapels'=>$mapel

        ]);
    }

    
    public function pertemuan(Request $request, $slug)
    {
    //    dd($slug);
        $siswa = DB::table('pertemuan')
        ->select('*')
        ->get();

        return view('absensi.pertemuan',[
            'title'=>'Absen Siswa | SMPN 1 Sipora',
            'pertemuan'=>$siswa,
            'slug'=>$slug
        
           ]);
    }


    public function someMethod(Request $request, $slug, $id)
    {
        // dd($id);
        $mapel = DB::table('jadwalmapels')
        ->join('mapels','mapels.id', '=', 'jadwalmapels.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        ->select('jadwalmapels.*', 'mapels.mapel', 'kelas.kelas')
        ->where('jadwalmapels.slug',$slug)
        ->first();

         $user=auth()->user()->id;
        $guru = guru::where('user_id',$user)->first();
        $kelassiswa=$guru->id;
        $siswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->select('siswa.*', 'users.nama','users.nik')
        ->where('siswa.kelas_id',$mapel->kelas_id)
        ->get();

        foreach ($siswa as $key ) {
            $absensi[] = DB::table('absensi')
            ->select('status','id')
            ->where('id_siswa',$key->id)
            ->where('id_jadmapel',$mapel->id)
            ->where('id_pertemuan',$id)
            ->get();
        }
        // dd($absensi);
        $absen = absensi::count();

        return view('absensi.absensi',[
            'title'=>'Absen Siswa | SMPN 1 Sipora',
            'siswa'=>$siswa,
            'mapels'=>$mapel,
            'guru' => $kelassiswa,
            'pertemuan' =>$id,
            'idjadmapel'=>$slug,
            'absen'=>$absen,
            'absensi' =>$absensi
           ]);
    }
    

    public function detailabsen(Request $request, $slug)
    {
     
        $absensi = DB::table('absensi')
        ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->select('absensi.*', 'users.nik','users.nama',)
        ->where('siswa.slug',$slug)
        ->get();

        $namasiswa = DB::table('jadwalmapels')
        ->join('mapels','mapels.id', '=', 'jadwalmapels.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        ->join('siswa','kelas.id', '=', 'siswa.kelas_id')
        ->join('users','siswa.user_id', '=', 'users.id')
        ->select('jadwalmapels.*', 'mapels.mapel', 'kelas.kelas','siswa.slug', 'users.nik', 'users.nama')
        ->where('siswa.slug',$slug)
        ->first();

        $siswa = DB::table('siswa')
        ->join('users','siswa.user_id', '=', 'users.id')
        ->select('siswa.*', 'users.nik', 'users.nama')
        ->where('siswa.slug',$slug)
        ->first();
        return view('absensi.detailabsen',[
            'title'=>'Nilai UTS | SMPN 1',
            'absensi'=>$absensi,
            // 'typeujian'=>$title,
            'namasiswa' => $namasiswa,
            'siswa'=>$siswa
           ]);
    }

    public function absensiswa()
    {
        $user=auth()->user()->id;
        $siswa = siswa::where('user_id',$user)->first();
        $kelassiswa=$siswa->kelas_id;

        $jadwalmapels = DB::table('jadwalmapels')
        ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
            ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
            ->join('users', 'gurus.user_id', '=', 'users.id')
            ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik')
            ->where('jadwalmapels.kelas_id',$kelassiswa)
            ->get();
                foreach($jadwalmapels as $mapel):
                    $totalhadir[] = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS total')
                        ->where('status', '=', '1')
                        ->where('id_siswa',$siswa->id)
                        ->where('id_jadmapel',$mapel->id)
                        ->get();
                    $totalizin[] = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS totalizin')
                        ->where('status', '=', '2')
                        ->where('id_siswa',$siswa->id)
                        ->where('id_jadmapel',$mapel->id)
                        ->get();
                    $totalalfa[] = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS totalalfa')
                        ->where('status', '=', '3')
                        ->where('id_siswa',$siswa->id)
                        ->where('id_jadmapel',$mapel->id)
                        ->get();
                endforeach;
                // dd($totalhadir);
        return view('absensi.absensiswa',[
            'title' =>'SMPN 1 | jadwalmapel',
            'jadwalmapels'=>$jadwalmapels,
            'totalhadir'=>$totalhadir,
            'totalizin'=>$totalizin,
            'totalalfa'=>$totalalfa,
            // 'jadwalmapels'=>jadwalmapel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // dd($request);
        $validatedData = $request->validate([
            'id_siswa' => 'required',
            'id_guru'=>'required',
            'id_jadmapel'=>'required',
            'id_pertemuan'=>'required',
            'status'=>'required',
        ]);
        // dd($request->jns_ujian);
        absensi::create($validatedData);
        return redirect('absensisiswa/'.$request->slug.'/'.$request->id_pertemuan)->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(absensi $absensi)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(absensi $absensi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, absensi $absensi)
    {
        $validatedData = $request->validate([
            'status' => 'required',
        ]);
        // dd($absensi->id);
        absensi::Where('id',$absensi->id)
               ->update($validatedData);
               return redirect('absensisiswa/'.$request->slug.'/'.$request->id_pertemuan)->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(absensi $absensi)
    {
        //
    }
}
