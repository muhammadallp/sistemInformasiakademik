<?php

namespace App\Http\Controllers;

use App\Models\walikelas;
use App\Models\kelas;
use App\Models\guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $walikelas =DB::table('walikelas')
        ->join('kelas', 'walikelas.kelas_id', '=', 'kelas.id')
        ->join('gurus', 'walikelas.guru_id', '=', 'gurus.id')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('walikelas.*','kelas.kelas','gurus.user_id','users.nik','users.nama')
        ->get();
        return view('walikelas.index',[
            'title'=> 'SMPN 1 Padang | Walikelas',
            'walikelas' => $walikelas,
            // 'kelas'=> Kelas::All()
          ]);
    }

    public function datasiswa()
    {
        $user=auth()->user()->id;
        $users= guru::where('user_id',$user)->first();
        // dd($users);
        
        $datakelas =DB::table('walikelas')
        ->join('gurus', 'walikelas.guru_id', '=', 'gurus.id')
        ->select('walikelas.*','gurus.user_id')
        ->where('walikelas.guru_id', $users->id)
        ->first();
        $datasiswa = DB::table('siswa')
        ->join('users', 'siswa.user_id', '=', 'users.id')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->join('tahunakademiks', 'siswa.thnakademik_id', '=', 'tahunakademiks.id')
        ->select('siswa.*', 'users.nik','users.nama','kelas.kelas','tahunakademiks.tahun')
        ->where('siswa.kelas_id', $datakelas->kelas_id)
        ->get();
        
        return view('datasiswa.index',[
            'title'=> 'SMPN 1 Padang | Walikelas',
            'siswa' => $datasiswa,
            // 'kelas'=> Kelas::All()
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
        ->select('gurus.*','users.nik','users.nama')
        ->get();
        return view('walikelas.create',[
            'title'=>'SMPN 1 Padang | Walikelas',
            'guru' => $guru,
            'kelas'=> kelas::all()
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
            'guru_id' => 'required',
            'kelas_id' => 'required',
        ]);
        walikelas::create($validatedData);
        return redirect('/walikelas')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\walikelas  $walikelas
     * @return \Illuminate\Http\Response
     */
    public function show(walikelas $walikelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\walikelas  $walikelas
     * @return \Illuminate\Http\Response
     */
    public function edit(walikelas $walikela)
    {
       
        $guru =DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('gurus.*','users.nik','users.nama')
        ->get();
        $datawalikelas = DB::table('walikelas')
                        ->join('gurus', 'walikelas.guru_id', '=', 'gurus.id')
                        ->join('users', 'gurus.user_id', '=', 'users.id')
                        ->join('kelas', 'walikelas.kelas_id', '=', 'kelas.id')
                        ->select('walikelas.*','gurus.user_id','users.nik','users.nama','kelas.kelas')
                        ->where('walikelas.id',$walikela->id)
                        ->first();

        return view('walikelas.edit',[
            'title'=>'SMPN 1 Padang | Walikelas',
            'walikelas'=>$datawalikelas,
            'guru' => $guru,
            'kelas'=> kelas::all()
        ]);
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\walikelas  $walikelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, walikelas $walikela)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
        ]);
        walikelas::Where('id',$walikela->id)
               ->update($validatedData);
        return redirect('/walikelas')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\walikelas  $walikelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(walikelas $walikela)
    {
        if ($walikela) {
            walikelas::destroy($walikela->id);
            return redirect('/walikelas')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect('/walikelas')->with('error', 'Data Tidak Ditemukan');
        }
    }
}
