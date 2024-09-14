<?php

namespace App\Http\Controllers;

use App\Models\pertemuan;
use Illuminate\Http\Request;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pertemuan.index',[
            'title'=> 'Data Pertemuan | SMPN 1 Sipora',
            'pertemuan' => pertemuan::All(),
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertemuan.create',[
            'title'=> 'Data Pertemuan | SMPN 1 Sipora',
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
            'keterangan' => 'required|max:255',
            'tanggal' => 'required',
        ]);

        pertemuan::create($validatedData);
        return redirect('/pertemuan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pertemuan  $pertemuan
     * @return \Illuminate\Http\Response
     */
    public function show(pertemuan $pertemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pertemuan  $pertemuan
     * @return \Illuminate\Http\Response
     */
    public function edit(pertemuan $pertemuan)
    {
        return view('pertemuan.edit',[
            'title'=> 'Data Pertemuan | SMPN 1 Sipora',
            'pertemuan'=>$pertemuan,
            // dd($kelas)
           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pertemuan  $pertemuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pertemuan $pertemuan)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required|max:255',
            'tanggal' => 'required',
        ]);
        pertemuan::Where('id',$pertemuan->id)
               ->update($validatedData);
        return redirect('/pertemuan')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pertemuan  $pertemuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pertemuan $pertemuan)
    {
        if ($pertemuan) {
            pertemuan::destroy($pertemuan->id);
            return redirect('/pertemuan')->with('success', 'Data Berhasil dihapus');
        } else {
            return redirect('/pertemuan')->with('error', 'Data Tidak Ditemukan');
        }
    }
    
}
