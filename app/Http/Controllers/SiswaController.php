<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use App\Models\kelas;
use App\Models\tahunakademik;
use App\Models\jadwalmapel;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa =DB::table('siswa')
        ->join('users', 'users.id', '=', 'siswa.user_id')
        ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
        ->join('tahunakademiks', 'tahunakademiks.id', '=', 'siswa.thnakademik_id')
        ->select('siswa.*','users.*','kelas.kelas','tahunakademiks.tahun')
        ->get();
        // dd($siswa);
        return view('siswa.index',[
            'title'=>'Data Siswa',
            'siswa'=>$siswa
        ]);
    }

    public function nilaiuts()
    {
        $user=auth()->user()->id;
        $siswa = siswa::where('user_id',$user)->first();
        $siwas_id=$siswa->id;

        $kelas =DB::table('nilai')
        ->select('nilai.kelas_id','nilai.semester')
        ->where('siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->groupby('kelas_id')
        ->groupby('semester')
        ->get();

    
        $jadwalmapels= DB::table('nilai')
        ->select('jadmapel_id', DB::raw('COUNT(nilai.id) as total_jadwal')) // Menggunakan COUNT() untuk menghitung jumlah baris
        ->where('nilai.siswa_id',$siwas_id)
        ->groupBy('jadmapel_id') // Group by kelas
        ->get();

        // dd($jadwalmapels);

        $nilai =DB::table('nilai')
        ->join('siswa', 'siswa.id', '=', 'nilai.siswa_id')
        ->join('gurus', 'gurus.id', '=', 'nilai.guru_id')
        ->join('users', 'users.id', '=', 'gurus.user_id')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->select('nilai.*','siswa.id','mapels.*','gurus.*','users.nik','users.nama')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai_uts')
        ->get();
        
        // dd($nilai);

        $totalmapel = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('Count(jadwalmapels.sks) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();

        // dd($totalmapel);
        $ipk = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('sum(nilai.nilai_uts) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();
        // dd($ipk);
        $totalsks = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('SUM(jadwalmapels.sks) as total_sks'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
         ->get();

        return view('siswa.nilaiuts',[
            'title'=>'Nilai UTS |SMPN 1 ',
            'nilai'=>$nilai,
            'semester'=>$kelas,
            'totalsks'=>$totalsks,
            'totalmapel'=>$totalmapel,
            'ipk'=>$ipk
        ]);
    }

    
    public function nilaiuas()
    {
        $user=auth()->user()->id;
        $siswa = siswa::where('user_id',$user)->first();
        $siwas_id=$siswa->id;

        $kelas =DB::table('nilai')
        ->select('nilai.kelas_id','nilai.semester')
        ->where('siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->groupby('kelas_id')
        ->groupby('semester')
        ->get();

        // dd($kelas);

        $nilai =DB::table('nilai')
        ->join('siswa', 'siswa.id', '=', 'nilai.siswa_id')
        ->join('gurus', 'gurus.id', '=', 'nilai.guru_id')
        ->join('users', 'users.id', '=', 'gurus.user_id')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        // ->select('*')
        ->select('nilai.*','siswa.id','mapels.*','gurus.*','users.nik','users.nama')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai_uts')
        ->get();
        
        // dd($nilai);

        $totalmapel = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('Count(jadwalmapels.sks) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();

        // dd($totalmapel);
        $ipk = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('sum(nilai.nilai_uas) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();
        // dd($ipk);
        $totalsks = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('SUM(jadwalmapels.sks) as total_sks'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
         ->get();

        return view('siswa.nilaiuas',[
            'title'=>'Nilai UAS |SMPN 1 ',
            'nilai'=>$nilai,
            'semester'=>$kelas,
            'totalsks'=>$totalsks,
            'totalmapel'=>$totalmapel,
            'ipk'=>$ipk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('level','siswa')->get();

        return view('siswa.create',[
            'title'=>'Data Siswa | SMPN 1',
            'users'=>$users,
            'tahunakademiks'=>tahunakademik::All(),
            'kelas'=>kelas::All()

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
            'user_id' =>'required',
            'slug'    =>'',
            'alamat'  =>'required',
            'nohp'    =>'required|min:12|max:13',
            'jk'      =>'required',
            'kelas_id'=>'required',
            'thnakademik_id'=>'required'
        ]);
        siswa::create($validatedData);
        return redirect('/siswa')->with('success', 'Data Berhasil Ditambahkan');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(siswa $siswa)
    {
        $users = user::where('level','siswa')->get();

        $siswas =DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->where('siswa.id',$siswa->id)
        ->select('siswa.user_id','siswa.slug','users.nik','users.nama')
        ->first();
        // dd($siswa);
        $kelassiswa =DB::table('kelas')
        ->where('id',$siswa->kelas_id)
        ->select('*')
        ->first();
        $thnakademik =DB::table('tahunakademiks')
        ->where('id',$siswa->thnakademik_id)
        ->select('*')
        ->first();
        return view('siswa.edit',[
            'title'=>'Data Siswa | SMPN 1',
            'users'=>$users,
            'siswa'=>$siswa,
            'siswas'=>$siswas,
            'kelassiswa'=>$kelassiswa,
            'thnakademik'=>$thnakademik,
            'tahunakademiks'=>tahunakademik::All(),
            'kelas'=>kelas::All()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswa $siswa)
    {
        // dd($siswa);
        $validatedData = $request->validate([
            'user_id' =>'required',
            'slug'    =>'',
            'alamat'  =>'required',
            'nohp'    =>'required|min:12|max:13',
            'jk'      =>'required',
            'kelas_id'=>'required',
            'thnakademik_id'=>'required'
        ]);
        // dd($validatedData);
        siswa::Where('id',$siswa->id)
              ->update($validatedData);
        return redirect('/siswa')->with('success', 'Data Berhasil Diupdate');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswa $siswa)
    {
        //
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(siswa::class, 'slug', $request->nohp);
        return response()->json(['slug'=>$slug]);
    
    }

    public function daftarmapel()
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
        return view('siswa.daftarmapel',[
            'title' =>'Daftar Mapel | SMPN 1',
            'jadwalmapels' =>$jadwalmapels
        ]);

    }

    public function laporanmapel()
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
         
        $pdf = Pdf::loadView('siswa.laporanmapel',[
            'title' =>'Daftar Mapel | SMPN 1',
            'jadwalmapels' =>$jadwalmapels
        ]);
        // $pdf = Pdf::loadView('siswa.laporan', $data);
        return $pdf->download('Daftar Matapelajaran.pdf');
        
    }

    public function laporannilai()
    {
        $user=auth()->user()->id;
        $siswa = siswa::where('user_id',$user)->first();
        $siwas_id=$siswa->id;

        $kelas =DB::table('nilai')
        ->select('nilai.kelas_id','nilai.semester')
        ->where('siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->groupby('kelas_id')
        ->groupby('semester')
        ->get();

        $nilai =DB::table('nilai')
        ->join('siswa', 'siswa.id', '=', 'nilai.siswa_id')
        ->join('gurus', 'gurus.id', '=', 'nilai.guru_id')
        ->join('users', 'users.id', '=', 'gurus.user_id')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        // ->select('*')
        ->select('nilai.*','siswa.id','jadwalmapels.mapel_id','jadwalmapels.sks','mapels.*','gurus.*','users.nik','users.nama')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai_uts')
        ->get();
        
        // dd($nilai);

        $totalmapel = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('Count(jadwalmapels.sks) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();

        // dd($totalmapel);
        $ipk = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('sum(nilai.nilai_uts) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();
        // dd($ipk);
        $totalsks = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('SUM(jadwalmapels.sks) as total_sks'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
         ->get();
         
        $pdf = Pdf::loadView('siswa.laporan',[
            'nilai'=>$nilai,
            'semester'=>$kelas,
            'totalsks'=>$totalsks,
            'totalmapel'=>$totalmapel,
            'ipk'=>$ipk
        ]);
        // $pdf = Pdf::loadView('siswa.laporan', $data);
        return $pdf->download('laporan-nilai-UTS.pdf');
        
    }
    public function laporannilaiuas()
    {
        $user=auth()->user()->id;
        $siswa = siswa::where('user_id',$user)->first();
        $siwas_id=$siswa->id;

        $kelas =DB::table('nilai')
        ->select('nilai.kelas_id','nilai.semester')
        ->where('siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->groupby('kelas_id')
        ->groupby('semester')
        ->get();

        // dd($kelas);

        $nilai =DB::table('nilai')
        ->join('siswa', 'siswa.id', '=', 'nilai.siswa_id')
        ->join('gurus', 'gurus.id', '=', 'nilai.guru_id')
        ->join('users', 'users.id', '=', 'gurus.user_id')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        // ->select('*')
        ->select('nilai.*','siswa.id','jadwalmapels.mapel_id','jadwalmapels.sks','mapels.*','gurus.*','users.nik','users.nama')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai_uts')
        ->get();
        
        // dd($nilai);

        $totalmapel = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('Count(jadwalmapels.sks) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();

        // dd($totalmapel);
        $ipk = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('sum(nilai.nilai_uas) as ratanilai'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
        ->get();
        // dd($ipk);
        $totalsks = DB::table('nilai')
        ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
        ->join('jadwalmapels', 'jadwalmapels.mapel_id', '=', 'mapels.id')
        ->select('nilai.semester', DB::raw('SUM(jadwalmapels.sks) as total_sks'))
        ->groupBy('nilai.semester')
        ->where('nilai.siswa_id',$siwas_id)
        // ->where('nilai.jns_ujian','UTS')
         ->get();
         
        $pdf = Pdf::loadView('siswa.laporannilaiuas',[
            'nilai'=>$nilai,
            'semester'=>$kelas,
            'totalsks'=>$totalsks,
            'totalmapel'=>$totalmapel,
            'ipk'=>$ipk
        ]);
        // $pdf = Pdf::loadView('siswa.laporan', $data);
        return $pdf->download('laporan-nilai-UAS.pdf');
        
    }


    public function search(Request $request)
    {

        return view('siswa.laporansiswa',[
            'title'=>'Data Guru',
            'tahunakademik' => tahunakademik::all()
        ]);
    }
    
    public function viewpdf(Request $request)
    {
   
        $year = $request->input('year');
        $data =  DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->join('tahunakademiks', 'siswa.thnakademik_id', '=', 'tahunakademiks.id')
        ->select('users.*','siswa.*', 'kelas.kelas','tahunakademiks.tahun')
        ->where('tahunakademiks.tahun', $year)
        ->get();
        $pdf = Pdf::loadView('siswa.cetak_laporan',[
            'gurus'=>$data,
            'tahunakademik'=>$year,
        ]);
        // $pdf = Pdf::loadView('siswa.cetak_laporan', $data);
        return $pdf->download('laporan-data-Siswa.pdf');
        
    }
    
    public function laporan(Request $request)

    {
        $year = $request->input('year');
        $cuti = DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('tahunakademiks', 'siswa.thnakademik_id', '=', 'tahunakademiks.id')
            ->select('users.*','siswa.*', 'kelas.kelas','tahunakademiks.tahun')
            ->where('tahunakademiks.tahun', $year)
            ->get();
           
            $results = $cuti;
        return view('siswa.laporandetailsiswa', [
            'title'=>'Data Guru',
            'year' =>$year,
            'resulst'=>$cuti
        ],
        compact('results'));
        // return view('cuti.laporan');
    }


}
