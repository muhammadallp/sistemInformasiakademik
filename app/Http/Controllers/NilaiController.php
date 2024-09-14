<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\guru;
use App\Models\jadwalmapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NilaiController extends Controller
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
        $jadwalmapels= DB::table('jadwalmapels')
        ->select('kelas_id', DB::raw('COUNT(jadwalmapels.id) as total_jadwal')) // Menggunakan COUNT() untuk menghitung jumlah baris
        ->where('jadwalmapels.guru_id', $guru)
        ->groupBy('kelas_id') // Group by kelas
        ->get();
        // dd($mapel);

        foreach ( $jadwalmapels as $a):
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
        return view('nilai.index',[
            'title' => 'Siswa',
            'jadwalmapels'=>$mapel

        ]);
    }
    public function nilaiuas()
    {
        $user=auth()->user()->id;
        $siswa = guru::where('user_id',$user)->first();
        $guru=$siswa->id;
      $jadwalmapels = DB::table('jadwalmapels')
        ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
            ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
            ->join('users', 'gurus.user_id', '=', 'users.id')
            ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik')
            ->where('jadwalmapels.guru_id',$guru)
            ->get();
        return view('nilai.index',[
            'title' => 'UAS',
            'jadwalmapels'=>$jadwalmapels
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required',
            'guru_id'=>'required',
            'kelas_id'=>'required',
            'jadmapel_id'=>'required',
            'nilai_uts'=>'required',
            'slug'=>'required',
            'thnakademik_id'=>'required',
            'semester'=>'required',
            'sks'=>'required',
            
        ]);
        
        // dd($request->jns_ujian);
        nilai::create($validatedData);
        return redirect('nilaiujian/'.$request->slug )->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        // dd($nilai->id);

        $jadwalmapels = DB::table('jadwalmapels')
        ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
        ->join('nilai', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik', 'nilai.*')
        ->where('nilai.id',$nilai->id)
        // ->where('nilai.jns_ujian',$title)
        ->first();
        return view('nilai.create',[
            'title' => 'Siswa',
            'jadwalmapel' =>$jadwalmapels
            // 'nilai'=>$jadwalmapels

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {   
        $validatedData = $request->validate([
            'siswa_id' => '',
            'jadmapel_id'=>'required',
            'nilai_uts'=>'required',
            'nilai_uas'=>'required',
            'nilai_tugas'=>'required',
            'nilai_uh'=>'required',
            'nilai_raport'=>'required',
            'sikap'=>'required',
            'slug'=>'required',
            'nilai_keterampilan'=>'required',

        ]);
        Nilai::Where('id',$nilai->id)
               ->update($validatedData);
        return redirect('nilaiujian/'.$nilai->slug )->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        $jadwalmapel = DB::table('nilai')
               ->join('mapels','mapels.id', '=', 'nilai.jadmapel_id')
               ->join('jadwalmapels','mapels.id', '=', 'jadwalmapels.mapel_id')
               ->select('jadwalmapels.*', 'nilai.*')
               ->where('jadwalmapels.mapel_id',$nilai->jadmapel_id)
               ->first();
            //    dd($jadwalmapel);
            nilai::destroy($nilai->id);
            return redirect('nilaiujian/'.$jadwalmapel->slug )->with('success', 'Data Berhasil dihapus');
     
    }
}
