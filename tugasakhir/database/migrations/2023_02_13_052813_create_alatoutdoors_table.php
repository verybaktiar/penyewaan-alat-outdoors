<?php

use App\Models\Alatoutdoor;
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
        Schema::create('alatoutdoors', function (Blueprint $table) {
            $table->string('id_alatoutdoor',8)->primary();
            $table->string('nama_alat',40);
            $table->string('id_kategori',8);
            $table->foreign('id_kategori')->references('id_kategori')
            ->on('kategoris')->onDelete('cascade')->nullable();
            $table->string('spesifikasi',50);
            $table->string('deskripsi',100);
            $table->string('stok',10);
            $table->string('harga_sewa',20);
            $table->string('merk',50);
            $table->string('image');
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
        Schema::dropIfExists('alatoutdoors');
    }
};
