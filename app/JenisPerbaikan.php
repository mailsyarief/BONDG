<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPerbaikan extends Model
{
    protected $table = 'jenis_perbaikan';
    protected $fillable = [
        'nama_perbaikan'
    ];

    public function laporan(){
        return $this->hasMany(bondg::class, 'id', 'id_jenis_perbaikan');
    }
}
