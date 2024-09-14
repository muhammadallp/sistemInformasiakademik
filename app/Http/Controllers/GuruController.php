<?php

namespace App\Http\Controllers;

use App\Models\guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru =DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('*')
        ->get();
        return view('guru.index',[
            'title'=>'SMPN 1 padang | Data Guru',
            'gurus'=>$guru

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = user::where('level','guru')->get();
        return view('guru.create',[
            'title'=>'Data Guru',
            'users'=>$users

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
            'user_id' => 'required',
            'slug'=>'',
            'nohp'=>'required|min:12|max:13',
            'jk'=>'required'
        ]);
        guru::create($validatedData);
        return redirect('/guru')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(guru $guru)
    {
        $gurus =DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->where('gurus.id',$guru->id)
        ->select('users.id','gurus.slug','users.nik','users.nama')
        ->first();
        // DD($guru->slug);
        $users = user::where('level','guru')->get();
        return view('guru.edit',[
            'title'=>'Data Guru',
            'users'=>$users,
            'gurus'=>$gurus,
            'guru'=>$guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, guru $guru)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'slug'=>'',
            'nohp'=>'required|min:12|max:13',
            'jk'=>'required'
        ]);
        guru::where('id',$guru->id)
             ->update($validatedData);
        return redirect('/guru')->with('success', 'Data Berhasil DiUpdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(guru $guru)
    {
        guru::destroy($guru->id);
        return redirect('/guru')->with('success', 'Data Berhasil DiHapus');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(guru::class, 'slug', $request->nohp);
        return response()->json(['slug'=>$slug]);
    }


    public function search(Request $request)
    {
        return view('guru.laporan',[
            'title'=>'Data Guru',
        ]);
    }
    
    public function view_pdf(Request $request)
    {
   
        $year = $request->input('year');
        $data = DB::table('gurus')
        ->join('users', 'gurus.user_id', '=', 'users.id')
        ->select('users.*','gurus.*')
        ->whereYear('gurus.created_at', $year)
        ->get();
        $pdf = Pdf::loadView('guru.cetak_laporan',[
            'gurus'=>$data,
            'tahun'=>$year,
        ]);
        // $pdf = Pdf::loadView('guru.cetak_laporan', $data);
        return $pdf->download('laporan-data-guru.pdf');
        
    }
    
    public function laporan(Request $request)

    {
        $year = $request->input('year');
        $cuti = DB::table('gurus')
            ->join('users', 'gurus.user_id', '=', 'users.id')
            ->select('users.*','gurus.*')
            ->whereYear('gurus.created_at', $year)
            ->get();
            $results = $cuti;
        return view('guru.laporanguru', [
            'title'=>'Data Guru',
            'year' =>$year,
            'resulst'=>$cuti
        ],
        compact('results'));
        // return view('cuti.laporan');
    }
}
