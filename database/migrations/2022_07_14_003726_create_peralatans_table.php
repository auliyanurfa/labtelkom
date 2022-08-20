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
        Schema::create('peralatans', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique();
            $table->string('nama_alat');
            $table->foreignId('jenis_id');
            $table->text('merk');
            $table->text('tipe');
            $table->text('spesifikasi')->nullable();
            $table->year('tahun_masuk');
            $table->integer('jumlah_alat')->default(1);
            $table->enum('kondisi', ['Baik', 'Rusak','Dalam Perbaikan']);
            $table->foreignId('lokasi_id');
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
        Schema::dropIfExists('peralatans');
    }
};
