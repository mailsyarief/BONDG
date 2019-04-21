<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBondgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bondg', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('posko');
            $table->string('nodg');
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
            $table->date('tglpk')->nullable();
            $table->date('tglkirimpetugas')->nullable();
            $table->date('tglterpasang')->nullable();
            $table->date('tglremaja')->nullable();
            $table->date('tglbatal')->nullable();
            $table->string('status')->default("Laporan");
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
