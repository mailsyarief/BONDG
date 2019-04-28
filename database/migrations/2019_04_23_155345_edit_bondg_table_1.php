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
            $table->string('alamat')->nullable();      
            $table->datetime('tglpk')->nullable()->change();
            $table->datetime('tglkirimpetugas')->nullable()->change();
            $table->datetime('tglterpasang')->nullable()->change();
            $table->datetime('tglremaja')->nullable()->change();
            $table->datetime('tglbatal')->nullable()->change();
            $table->string('keluhan')->nullable();
            $table->string('perbaikan')->nullable();
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
