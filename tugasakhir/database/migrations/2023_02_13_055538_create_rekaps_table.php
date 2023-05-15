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
        Schema::create('rekaps', function (Blueprint $table) {
            $table->string('id_rekap',8)->primary();
            $table->string('id_pelanggan',6);
            $table->foreign('id_pelanggan')->references('id_pelanggan')
            ->on('pelanggans')->onDelete('cascade');
            $table->string('id_alatoutdoor',8);
            $table->foreign('id_alatoutdoor')->references('id_alatoutdoor')
            ->on('alatoutdoors')->onDelete('cascade');
            $table->string('masa_sewa',3);
            $table->date('tgl_penyewaan',10);
            $table->date('tgl_pengembalian',10);
            $table->string('status_kembali',15);
            $table->string('denda',10);
            $table->string('id_admin',7);
            $table->foreign('id_admin')->references('id_admin')
            ->on('admins')->onDelete('cascade');
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
        Schema::dropIfExists('pengembalians');
    }
};
