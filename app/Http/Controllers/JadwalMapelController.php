<?php

namespace App\Http\Controllers;

use App\Models\jadwalmapel;
use App\Models\kelas;
use App\Models\mapel;
use App\Models\guru;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class JadwalMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalmapels = DB::table('jadwalmapels')
        ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
            ->join('tahunakademiks', 'tahunakademiks.id', '=', 'jadwalmapels.thunakademik_id')
            ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
            ->join('users', 'gurus.user_id', '=', 'users.id')
            ->select('jadwalmapels.*','kelas.kelas','tahunakademiks.tahun', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik')
            ->get();
            // dd($jadwalmapels);
        return view('jadwalmapel.index',[
            'title' =>'SMPN 1 | jadwalmapel',
            'jadwalmapels'=>$jadwalmapels
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
        $guru =DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('users.nik','users.nama', 'gurus.*')
        ->get();

        $tahun = date('Y');
        $tahunakademik = DB::table('tahunakademiks')
        ->select('*')
        ->where('tahun', 'like', '%'.$tahun.'%')
        ->first();

        // dd($tahunakademik->id);
        return view('jadwalmapel.create',[
            'title'=>'SMPN 1 | Jadwalmapel',
            'mapels'=>mapel::all(),
            'kelas'=>kelas::all(),
            'guru'=>$guru,
            'tahunakademik' =>$tahunakademik
        ]);
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
            'mapel_id' => 'required',
            'slug'=>'',
            'kelas_id'=>'required',
            'guru_id'=>'required',
            'thunakademik_id'=>'required',
            'sks'=>'required',
            'semester'=>'required',
            'hari'=>'required',
            'jam_masuk'=>'required',
            'jam_keluar'=>'required',
        ]);
        jadwalmapel::create($validatedData);
        return redirect('/jadwalmapel')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwalmapel  $jadwalmapel
     * @return \Illuminate\Http\Response
     */
    public function show(jadwalmapel $jadwalmapel)
    {
        
    }


    public function someMethod(Request $request, $slug)
    {

       
        $title = $request->query('title', 'Default Title'); // Jika title tidak ada, berikan nilai default

        $mapel = DB::table('jadwalmapels')
        ->join('mapels','mapels.id', '=', 'jadwalmapels.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        ->select('jadwalmapels.*', 'mapels.mapel', 'kelas.kelas')
        ->where('jadwalmapels.slug',$slug)
        ->first();
        $siswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->select('siswa.*', 'users.nama','users.nik')
        ->where('siswa.kelas_id',$mapel->kelas_id)
        ->get();
        foreach ($siswa as $value) {
         $siswanilai[]= DB::table('nilai')
        ->select('*')
        ->where('jadmapel_id',$mapel->mapel_id)
        ->where('siswa_id',$value->id)
        // ->where('nilai.jns_ujian',$title)
        ->get();
        }
        $jadwalmapels = DB::table('jadwalmapels')
            ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
            ->join('gurus', 'gurus.id', '=', 'jadwalmapels.guru_id')
            ->join('nilai', 'mapels.id', '=', 'nilai.jadmapel_id')
            ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->select('jadwalmapels.*','kelas.kelas', 'mapels.mapel', 'gurus.user_id','users.nama', 'users.nik', 'nilai.*')
            ->where('jadwalmapels.slug',$slug)
            ->get();
        
        return view('nilai.nilaiuts',[
            'title'=>'Nilai UTS | SMPN 1',
            'jadwalmapels'=>$jadwalmapels,
            'mapels'=>$mapel,
            'siswa'=>$siswa,
            'typeujian'=>$title,
            'siswanilai'=> $siswanilai,
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwalmapel  $jadwalmapel
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwalmapel $jadwalmapel)
    {
        
        $guru =DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('users.nik','users.nama', 'gurus.*')
        ->get();

        $tahun = date('Y');
        $tahunakademik = DB::table('tahunakademiks')
        ->select('*')
        ->where('id',$jadwalmapel->thunakademik_id)
        ->first();

        $mapels = DB::table('mapels')
        ->select('*')
        ->where('id',$jadwalmapel->mapel_id)
        ->first();

        $kelas = DB::table('kelas')
        ->select('*')
        ->where('id',$jadwalmapel->kelas_id)
        ->first();

        $gurus = DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('users.nik','users.nama', 'gurus.*')
        ->where('gurus.id',$jadwalmapel->guru_id)
        ->first();

        // dd($tahunakademik->id);
        return view('jadwalmapel.edit',[
            'title'=>'SMPN 1 | Jadwalmapel',
            'mapels'=>mapel::all(),
            'kelas'=>kelas::all(),
            'kelass'=>$kelas,
            'guru'=>$guru,
            'gurus'=>$gurus,
            'tahunakademik' =>$tahunakademik,
            'jadwalmapel' =>$jadwalmapel,
            'mapell'=>$mapels
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jadwalmapel  $jadwalmapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jadwalmapel $jadwalmapel)
    {
        $validatedData = $request->validate([
            'mapel_id' => 'required',
            'slug'=>'',
            'kelas_id'=>'required',
            'guru_id'=>'required',
            'thunakademik_id'=>'required',
            'sks'=>'required',
            'semester'=>'required',
            'hari'=>'required',
            'jam_masuk'=>'required',
            'jam_keluar'=>'required',
        ]);
        jadwalmapel::where('id',$jadwalmapel->id)
        ->update($validatedData);
        return redirect('/jadwalmapel')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwalmapel  $jadwalmapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwalmapel $jadwalmapel)
    {
        jadwalmapel::destroy($jadwalmapel->id);
        return redirect('/jadwalmapel')->with('success', 'Data Berhasil DiHapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(jadwalmapel::class, 'slug', $request->semester);
        return response()->json(['slug'=>$slug]);
    }
}
