<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\bondg;

class OrderController extends Controller
{
    public function GetOrder(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ]);
        $bondg = bondg::select('posko', 'nodg as id_laporan', 'namapel as nama_pelapor', 'nohp as no_hp pelapor',
            'alamat as alamat_pelapor', 'keluhan', 'noagenda as nomor_agenda', 'tgldg as tgl_bln_thn', 'nometerlama as no_meter_lama', 'nometerbaru as no_meter_baru',
            'daya', 'gardu', 'perbaikan', 'tglkirimpetugas as tgl_kirim_petugas' )
            ->where('id_petugas', '=', $request->id)
            ->get();

        return response()->json(array(
            'error' => 0,
            'message' => $bondg->toArray(),
        ));
    }
}
