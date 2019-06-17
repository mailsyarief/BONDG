<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bondg;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('viewer');
    }

    public function index()
    {
        $bondg = bondg::orderBy('tgldg', 'desc')->get();
        $no = 1;
        return view('laporan', compact('bondg', 'no'));
    }
}
