<?php

namespace App\Http\Controllers;

use App\Models\tahunakademik;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tahunakademik.index',[
            'title'=>'Tahun Akademin | SMPN 1',
            'tahunakademiks' => tahunakademik::All(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahunakademik.create',[
            'title'=>'Tahun Akademik'
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
            'tahun' => 'required|max:255',
        ]);
        tahunakademik::create($validatedData);
        return redirect('/tahunakademik')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function show(tahunakademik $tahunakademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function edit(tahunakademik $tahunakademik)
    {
        return view('tahunakademik.edit',[
            'title'=>'Tahun Akademik',
            'tahunakademik'=>$tahunakademik

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tahunakademik $tahunakademik)
    {
        $validatedData = $request->validate([
            'tahun' => 'required|max:255',
        ]);
        tahunakademik::Where('id',$tahunakademik->id)
               ->update($validatedData);
        return redirect('/tahunakademik')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tahunakademik  $tahunakademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(tahunakademik $tahunakademik)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(tahunakademik::class, 'slug', $request->tahun);
        return response()->json(['slug'=>$slug]);
    }
}
