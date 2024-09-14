<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use App\Models\guru;
use App\Models\walikelas;
use App\Models\jadwalmapel;
class DashboardController extends Controller
{
    public function index()
    {
        $guru = guru::count();
        $siswa = siswa::count();
        $walikelas = walikelas::count();
        $jadwalmapel = jadwalmapel::count();
        
        return view('dashboard.index',[
            'title'=>'Dashboard',
            'guru' =>$guru,
            'siswa' =>$siswa,
            'walikelas' => $walikelas,
            'jadwalmapel'=>$jadwalmapel,
        ]);
    }
}
