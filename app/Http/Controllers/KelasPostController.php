<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class KelasPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelas.index',[
            'title'=> 'kelas',
            'kelas' => kelas::All(),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create',[
            'title'=>'kelas'
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
            'kelas' => 'required|max:255',
        ]);
        kelas::create($validatedData);
        return redirect('/kelas')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas $kela)
    {
        return view('kelas.edit',[
            'title'=>'SMPN 1',
            'kelas'=>$kela,
            // dd($kelas)
           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas $kela)
    {
        $validatedData = $request->validate([
            'kelas' => 'required|max:255',
        ]);
        kelas::Where('id',$kela->id)
               ->update($validatedData);
        return redirect('/kelas')->with('success', 'Data Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas $kela)
    {
        // dd($kelas);
        if ($kela) {
            kelas::destroy($kela->id);
            return redirect('/kelas')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect('/kelas')->with('error', 'Data Tidak Ditemukan');
        }
    }
    
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(kelas::class, 'slug', $request->kelas);
        return response()->json(['slug'=>$slug]);
    }
}
