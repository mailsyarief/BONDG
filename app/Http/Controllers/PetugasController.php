<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Session;
use Auth;
use App\bondg;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkactivestatus']);
        $this->middleware('petugas');
    }

    public function index()
    {
        $tugas = count(bondg::where('status', '=', 'Pengiriman WO')->where('id_petugas', '=', Auth::user()->id)->get());
        $terpasang = count(bondg::where('status', '=', 'Terpasang')->where('id_petugas', '=', Auth::user()->id)->get());
        $batal = count(bondg::where('status', '=', 'Batal')->orWhere('status', '=', 'Pengajuan Batal')->where('id_petugas', '=', Auth::user()->id)->orWhere('id_petugasbatal', '=', Auth::user()->id)->get());
        return view('home', compact('tugas', 'terpasang', 'batal'));
    }

    
}
