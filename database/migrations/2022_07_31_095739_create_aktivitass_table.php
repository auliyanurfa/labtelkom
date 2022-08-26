<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitass', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('mahasiswa_id');
            $table->foreignId('peralatan_id');
            $table->string('tgl_pinjam');
            $table->string('tgl_kembali')->nullable();
            $table->enum('status', ['pinjam', 'kembali']);
            $table->string('kondisi_awal');
            $table->string('kondisi_akhir')->nullable();
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
        Schema::dropIfExists('aktivitass');
    }
};
