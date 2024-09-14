<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
// use App\Models\Kelas;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mapel.mapel',[
            'title'=> 'SMPN 1 Padang | Mapel',
            'mapels' => Mapel::All(),
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
       return view('mapel.create',[
        'title'=>'mapel',
        // 'kelas'=> Kelas::All()
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
            'mapel' => 'required|max:255',
            'slug' => '',
            'kbm' => 'required',
            'kelompok' => 'required',
        ]);
        Mapel::create($validatedData);
        return redirect('/mapel')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        return view('mapel.edit',[
            'title'=>'mapel',
            'mapel'=>$mapel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $validatedData = $request->validate([
            'mapel' => 'required|max:255',
        ]);
        mapel::Where('id',$mapel->id)
               ->update($validatedData);
        return redirect('/mapel')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        if ($mapel) {
            mapel::destroy($mapel->id);

            return redirect('/mapel')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect('/mapel')->with('error', 'Data Tidak Ditemukan');
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Mapel::class, 'slug', $request->mapel);
        return response()->json(['slug'=>$slug]);
    }
}
