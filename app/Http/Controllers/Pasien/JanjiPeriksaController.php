<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JanjiPeriksaController extends Controller
{
    public function index(){
         $no_rm = Auth::user()->no_rm;
        $dokters = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();

        return view('pasien.janji-periksa.index')->with([
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
        return view('pasien.janji-periksa.index');
    }
}
