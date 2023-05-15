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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->string('id_sewa',7)->primary();
            $table->string('id_pelanggan',6);
            $table->foreign('id_pelanggan')->references('id_pelanggan')
            ->on('pelanggans')->onDelete('cascade');
            $table->string('id_keranjang',7);
            $table->foreign('id_keranjang')->references('id_keranjang')
            ->on('keranjangs')->onDelete('cascade');
            $table->json('detail_alatoutdoor');
            $table->string('masa_sewa',10);
            $table->date('tgl_penyewaan',10);
            $table->date('tgl_ambil',10);
            $table->date('tgl_haruskembali',10);
            $table->string('status_sewa',15);
            $table->enum('jaminan', ['KTP', 'SIM']);
            $table->binary('foto_jaminan');
            $table->string('total',10);
            $table->binary('bukti_bayar');
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
        Schema::dropIfExists('penyewaans');
    }
};
