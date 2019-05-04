<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBondgTableFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bondg', function (Blueprint $table) {
            $table->string('nodg')->primary();
            $table->string('posko');            
            $table->string('namapel');
            $table->string('idpel');
            $table->string('nohp');
            $table->string('gardu');
            $table->string('tarif');
            $table->string('daya');
            $table->string('noagenda')->nullable();
            $table->string('nometerlama');
            $table->string('nometerbaru')->nullable();
            $table->date('tgldg');
            $table->datetime('tglkirimpetugas')->nullable();
            $table->datetime('tglterpasang')->nullable();
            $table->datetime('tglremaja')->nullable();
            $table->datetime('tglbatal')->nullable();
            $table->string('status')->default("Laporan");
            $table->string('alamat')->nullable();      
            $table->datetime('tglpk')->nullable();            
            $table->string('keluhan')->nullable();
            $table->string('perbaikan')->nullable();
            $table->integer('id_petugas')->nullable();
            $table->integer('waktupengerjaan')->default(0);          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bondg');
    }
}
