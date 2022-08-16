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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name_material');
            $table->string('barcode');
            $table->foreignId('unit_id');
            $table->text('spesifikasi');
            $table->text('type');
            $table->integer('stok');
            $table->integer('stok_masuk')->default(0);
            $table->integer('stok_keluar')->default(0);
            $table->enum('satuan', ['pcs', 'liter', 'meter']);
            $table->text('location');
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
        Schema::dropIfExists('materials');
    }
};
