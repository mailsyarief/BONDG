<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisGangguan extends Model
{
    protected $table = 'jenis_gangguan';
    protected $fillable = [
        'nama_gangguan'
    ];

    public function laporan(){
        return $this->hasMany(bondg::class, 'id', 'id_jenis_gangguan');
    }
    
}
