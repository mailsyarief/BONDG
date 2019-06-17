<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditBondgTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bondg', function (Blueprint $table) {
            $table->string('kwhmeterlama_merk')->nullable();
            $table->string('kwhmeterlama_type')->nullable();
            $table->string('kwhmeterlama_th')->nullable();
            $table->string('kwhmeterlama_sisakwh')->nullable();
            $table->string('kwhmeterbaru_merk')->nullable();
            $table->string('kwhmeterbaru_type')->nullable();
            $table->string('kwhmeterbaru_th')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('ts_kwh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
