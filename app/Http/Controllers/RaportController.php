<?php

namespace App\Http\Controllers;

use App\Models\raport;
use App\Models\user;
use App\Models\siswa;
use App\Models\guru;
use App\Models\nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class RaportController extends Controller
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

        // dd($users);
        
        $datakelas = DB::table('walikelas')
        ->join('gurus', 'walikelas.guru_id', '=', 'gurus.id')
        ->select('walikelas.*','gurus.user_id')
        ->where('walikelas.guru_id', $users->id)
        ->first();

        if ($datakelas === null) {
            $mapels = DB::table('jadwalmapels')
            // ->join('jadwalmapels', 'walikelas.guru_id', '=', 'gurus.id')
            ->select('*')
            ->where('guru_id', $users->id)
            ->get();

            return view('raport.index',[
                'title'=> 'Nilai Raport | SMPN 1 Sipora',
                'siswa' => $mapels,
              ]);
           

        } else {
        $datasiswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->join('tahunakademiks', 'siswa.thnakademik_id', '=', 'tahunakademiks.id')
        ->select('siswa.*', 'users.nik','users.nama','kelas.kelas','tahunakademiks.tahun')
        ->where('siswa.kelas_id', $datakelas->kelas_id)
        ->get();
        return view('raport.index',[
            'title'=> 'Nilai Raport | SMPN 1 Sipora',
            'siswa' => $datasiswa,
            // 'kelas'=> Kelas::All()
          ]);
        }
    }

    public function detailnilairaport(Request $request, $slug)
    {
       
        $siswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->join('jadwalmapels', 'kelas.id', '=', 'jadwalmapels.kelas_id')
        ->select('siswa.id','siswa.kelas_id','siswa.thnakademik_id', 'kelas.kelas','users.nama','users.nik','jadwalmapels.semester','jadwalmapels.guru_id')
        ->where('siswa.id',$slug)
        ->first();
        // dd($siswa);
        $jadwalmapels = DB::table('jadwalmapels')
            ->join('mapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('kelas', 'kelas.id', '=', 'jadwalmapels.kelas_id')
            ->select('jadwalmapels.mapel_id','kelas.kelas', 'mapels.mapel')
            ->where('jadwalmapels.kelas_id',$siswa->kelas_id)
            ->get();

            $nilairaport = DB::table('nilai')
            ->join('mapels', 'mapels.id', '=', 'nilai.jadmapel_id')
            ->join('jadwalmapels', 'mapels.id', '=', 'jadwalmapels.mapel_id')
            ->join('siswa', 'nilai.siswa_id', '=', 'siswa.id')
            ->join('users', 'users.id', '=', 'siswa.user_id')
            ->select('nilai.*','mapels.mapel','mapels.kbm','users.nik','users.nama','jadwalmapels.sks')
            ->where('nilai.kelas_id',$siswa->kelas)
            ->where('nilai.siswa_id',$siswa->id)
            ->get();
        return view('raport.nilairaport',[
            'title'=>'Nilai UTS | SMPN 1',
            'jadwalmapels'=>$jadwalmapels,
            'nilairaport'=>$nilairaport,
            'siswa'=>$siswa,
            // 'typeujian'=>$title
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
        $validatedData = $request->validate([
            'siswa_id' => 'required',
            'guru_id'=>'required',
            'mapel_id'=>'required',
            'kelas_id'=>'required',
            'thnakademik_id'=>'required',
            'semester'=>'required',
            'nilai'=>'required',
            'deskripsi'=>'required',
            
        ]);
        // dd($request->siswa_id);
        raport::create($validatedData);
        return redirect('detailnilairaport/'.$request->siswa_id)->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function show(raport $raport)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function edit(raport $raport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilairaport)
    {
        // dd($nilairaport);
        $validatedData = $request->validate([
            'siswa_id' => 'required',
            'deskripsi'=>'required',
            
        ]);
        // dd($request->siswa_id);
        Nilai::Where('id',$nilairaport->id)
               ->update($validatedData);
        return redirect('detailnilairaport/'.$request->siswa_id)->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\raport  $raport
     * @return \Illuminate\Http\Response
     */
    public function destroy(raport $nilairaport)
    {
    
        raport::destroy($nilairaport->id);
        return redirect('detailnilairaport/'.$nilairaport->siswa_id)->with('success', 'Data Berhasil dihapus');
     
    }

    public function search(Request $request)
    {
        $user=auth()->user()->id;
        $users= siswa::where('user_id',$user)->first();
        $semester =DB::table('nilai')
        ->select('kelas_id','semester')
        ->where('siswa_id',$users->id)
        ->groupby('kelas_id')
        ->groupby('semester')
        ->get();
        // dd($semester);
        return view('raport.laporanraport',[
            'title'=>'Data Guru',
            'semester'=>$semester
            // 'tahunakademik' => tahunakademik::all()
        ]);
    }
    
    public function viewpdf(Request $request)
    {
        $year = $request->input('year');
        $user=auth()->user()->id;
        $users= siswa::where('user_id',$user)->first();
        // dd($users);
        
        $kelassiswa=$users->kelas_id;

        $walikelas = DB::table('walikelas')
                ->join('kelas', 'kelas.id', '=', 'walikelas.kelas_id')
                ->select('walikelas.*')
                ->where('walikelas.kelas_id', $kelassiswa)
                ->first();

        $walikelas1 = DB::table('gurus')
                ->join('users', 'users.id', '=', 'gurus.user_id')
                ->select('users.nik', 'users.nama')
                ->where('gurus.id', $walikelas->guru_id)
                ->first();       

                    $totalhadir = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS totalhadir')
                        ->where('status', '=', '1')
                        ->where('id_siswa',$users->id)
                        ->first();
                    $totalizin = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS totalizin')
                        ->where('status', '=', '2')
                        ->where('id_siswa',$users->id)
                        ->first();
                    $totalalfa = DB::table('absensi')
                        ->selectRaw('COUNT(status) AS totalalfa')
                        ->where('status', '=', '3')
                        ->where('id_siswa',$users->id)
                        ->first();
                    // dd($totalalfa);
        $siswa = DB::table('nilai')
                ->join('tahunakademiks', 'nilai.thnakademik_id', '=', 'tahunakademiks.id')
                ->select('nilai.*','tahunakademiks.tahun')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->first();

                $sikap =  DB::table('nilai')
                ->select('nilai.sikap')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->groupBy('sikap')
                ->first();
        // dd($sikap);
                $cuti = DB::table('nilai')
                ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
                ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->where('mapels.kelompok', 'A')
                ->get();
            $kelompok = DB::table('nilai')
                ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
                ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->where('mapels.kelompok', 'B')
                ->get();
        $pdf = Pdf::loadView('raport.cetak_laporan',[
            'resulst'=>$cuti,
            'resulst1'=>$kelompok,
            'siswa'=>$siswa,
            'sikap'=>$sikap,
            'walikelas'=>$walikelas1,
            'totalhadir'=>$totalhadir,
            'totalizin'=>$totalizin,
            'totalalfa'=>$totalalfa,
        ]);
        // $pdf = Pdf::loadView('siswa.cetak_laporan', $data);
        return $pdf->download('raport.pdf');
        
    }

    public function cetakraport(Request $request)
    {
        $semester  = $request->input('year');
        $year = $request->input('semester');
        // dd($semester);
        $user=auth()->user()->id;
        $users= siswa::where('id',$semester)->first();
        $datasiswa = user::where('id',$users->user_id)->first();
        // dd($datasiswa);
        
        $kelassiswa=$users->kelas_id;
  
            $totalhadir = DB::table('absensi')
            ->selectRaw('COUNT(status) AS totalhadir')
            ->where('status', '=', '1')
            ->where('id_siswa',$users->id)
            ->first();
        $totalizin = DB::table('absensi')
            ->selectRaw('COUNT(status) AS totalizin')
            ->where('status', '=', '2')
            ->where('id_siswa',$users->id)
            ->first();
        $totalalfa = DB::table('absensi')
            ->selectRaw('COUNT(status) AS totalalfa')
            ->where('status', '=', '3')
            ->where('id_siswa',$users->id)
            ->first();
        $siswa = DB::table('nilai')
                ->join('tahunakademiks', 'nilai.thnakademik_id', '=', 'tahunakademiks.id')
                ->select('nilai.*','tahunakademiks.tahun')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->first();

                $sikap =  DB::table('nilai')
                ->select('nilai.sikap')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->groupBy('sikap')
                ->first();
        // dd($sikap);
                $cuti = DB::table('nilai')
                ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
                ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->where('mapels.kelompok', 'A')
                ->get();
            $kelompok = DB::table('nilai')
                ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
                ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
                ->where('nilai.semester', $year)
                ->where('nilai.siswa_id', $users->id)
                ->where('mapels.kelompok', 'B')
                ->get();
        $pdf = Pdf::loadView('raport.cetak_laporansiswa',[
            'resulst'=>$cuti,
            'resulst1'=>$kelompok,
            'siswa'=>$siswa,
            'sikap'=>$sikap,
            'datasiswa'=>$datasiswa,
            'totalhadir'=>$totalhadir,
            'totalizin'=>$totalizin,
            'totalalfa'=>$totalalfa,
        ]);
        return $pdf->download('raport.pdf');
        
    }
    
    public function laporan(Request $request)

    {
        $user=auth()->user()->id;
        $users= siswa::where('user_id',$user)->first();
        $year = $request->input('year');
        $cuti = DB::table('nilai')
            ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
            ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
            ->where('nilai.semester', $year)
            ->where('nilai.siswa_id', $users->id)
            ->where('mapels.kelompok', 'A')
            ->get();
        $kelompok = DB::table('nilai')
            ->join('mapels', 'nilai.jadmapel_id', '=', 'mapels.id')
            ->select('nilai.*','mapels.mapel', 'mapels.kelompok','mapels.kbm')
            ->where('nilai.semester', $year)
            ->where('nilai.siswa_id', $users->id)
            ->where('mapels.kelompok', 'B')
            ->get();
            $results = $cuti;
            $results1 = $kelompok;
        return view('raport.laporandetailraport', [
            'title'=>'Data Guru',
            'year' =>$year,
            'resulst'=>$cuti,
            'resulst1'=>$kelompok,
            
        ],
        compact('results'));
        // return view('cuti.laporan');
    }

}
