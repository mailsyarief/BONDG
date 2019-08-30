<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bondg extends Model
{
    protected $table = 'bondg';
    protected $primaryKey = 'nodg';
    protected $fillable = [
        'posko', 'nodg', 'namapel', 'idpel', 'nohp', 
        'gardu', 'tarif', 'daya', 'noagenda', 'nometerlama', 'nometerbaru', 'tgldg', 'tglpk', 'tglkirimpetugas',
        'tglterpasang', 'tglremaja', 'tglbatal', 'status', 'alamat', 'keluhan', 'perbaikan', 'id_petugas', 'waktupengerjaan',
        'cancel_1', 'cancel_2', 'filename_kwhlama', 'filename_kwhbaru', 'filename_ba', 'id_jenis_gangguan', 'id_jenis_perbaikan',
        'kwhmeterlama_type', 'kwhmeterlama_th', 'kwhmeterlama_merk', 'kwhmeterlama_sisakwh',  'kwhmeterbaru_type', 'kwhmeterbaru_th', 'kwhmeterbaru_merk'
    ];

    public function petugas(){
        return $this->belongsTo(user::class, 'id_petugas', 'id');
    }
    public function petugasBatal(){
        return $this->belongsTo(user::class, 'id_petugasbatal', 'id');
    }
    public function jenisGangguan(){
        return $this->belongsTo(jenisGangguan::class, 'id_jenis_gangguan', 'id');
    }
    public function jenisPerbaikan(){
        return $this->belongsTo(jenisPerbaikan::class, 'id_jenis_perbaikan', 'id');
    }
}
