<?php

namespace App\Imports;

use App\bondg;
use App\JenisGangguan;
use App\JenisPerbaikan;
use DateTime;
use Carbon\Carbon;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;
// use Maatwebsite\Excel\Concerns\SkipsOnError;
// use Maatwebsite\Excel\Concerns\SkipsErrors;

class BondgImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function headingRow(): int
    {
        return 1;
    }
    public function model(array $row)
    {
        // dump($row);
        
       
        $checkIdPel = bondg::where('idpel', '=', $row['idpel'])->where('status', '!=', 'Remaja')->get();
        if(count($checkIdPel)>0)
        {
            return null;
        }
        
        $gangguan  = JenisGangguan::where('nama_gangguan', $row['gangguan'])->get();
        $perbaikan = JenisPerbaikan::where('nama_perbaikan', $row['perbaikan'])->get();
        $dateTime = DateTime::createFromFormat('d/m/Y', $row['tgl_dg']);
        // dd(Carbon::parse($row['tgl_dg']));

        if (!isset($row['sisa_kwh_meter_lama'])) {
            $sisa = null;
        }
        else{
            $sisa = $row['sisa_kwh_meter_lama'];
        }
        if (!isset($row['merk_kwh_meter_lama'])) {
            $nama = null;
        }
        else{
            $nama = $row['merk_kwh_meter_lama'];
        }
        if (!isset($row['tipe_kwh_meter_lama'])) {
            $tipe =  null;
        }
        else{
            $tipe = $row['tipe_kwh_meter_lama'];
        }

        if (!isset($row['tahun_kwh_meter_lama'])) {
            $tahun = null;
        }
        else{
            $tahun = $row['tahun_kwh_meter_lama'];
        }
        
        if (!isset($row['merk_kwh_meter_baru'])) {
            $namaBaru = null;
        }
        else{
            $namaBaru = $row['merk_kwh_meter_baru'];
        }

        if (!isset($row['tipe_kwh_meter_baru'])) {
            $tipeBaru =  null;
        }
        else{
            $tipeBaru = $row['tipe_kwh_meter_baru'];
        }

        if (!isset($row['tahun_kwh_meter_baru'])) {
            $tahunBaru = null;
        }
        else{
            $tahunBaru = $row['tahun_kwh_meter_baru'];
        }
        //check gangguan
        if(count($gangguan)<1)
        {
            // dd("bye");
            $add = new JenisGangguan();
            $add->nama_gangguan = $row['gangguan'];
            $add->save();
            $idGangguan = $add->id;           
        }
        else
        {
            $idGangguan = $gangguan[0]->id;
        }

        //check perbaikan
        if(count($perbaikan)<1)
        {
            // dd("bye");
            $add = new JenisPerbaikan();
            $add->nama_perbaikan = $row['perbaikan'];
            $add->save();
            $idPerbaikan = $add->id;           
        }
        else
        {
            $idPerbaikan = $perbaikan[0]->id;
        }

        //check nodg
        if($idGangguan!=1)
        {
            $nodg = $idGangguan.Carbon::now()->format('YmdHis'); 
        }
        else {
            $nodg = $row['no_dg'];
        }

        // dd($nama);

        return new bondg([
            'id_jenis_gangguan'=> $idGangguan,       
            'id_jenis_perbaikan'=> $idPerbaikan,   
            'posko' => $row['posko'],
            'tgldg' => $dateTime,
            'tglpk' => $dateTime,
            'nodg' => $nodg,
            'namapel' =>$row['nama'],
            'idpel' =>$row['idpel'],
            'gardu' =>$row['gardu'],
            'tarif' => $row['tarif'],
            'daya' => $row['daya'],
            'nohp' => $row['no_hp'],
            'nometerlama'=> $row['kwh_meter_lama'],                    
            'kwhmeterlama_merk'=> $nama,   
            'kwhmeterlama_type'=> $tipe,    
            'kwhmeterlama_th'=> $tahun,    
            'kwhmeterlama_sisakwh'=> $sisa,    
            'status' => 'Cetak PK',   
            'nometerbaru'=> $row['kwh_meter_baru'],                  
            'noagenda'=> $row['no_agenda'],    
            'kwhmeterbaru_merk'=> $namaBaru,   
            'kwhmeterbaru_type'=> $tipeBaru,    
            'kwhmeterbaru_th'=> $tahunBaru,
            'alamat' => $row['alamat'],       
        ]);
        // dd($lol);
        
    }
}
