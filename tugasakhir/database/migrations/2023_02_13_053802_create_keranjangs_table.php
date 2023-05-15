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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->string('id_keranjang',7)->primary();
            $table->string('id_pelanggan',6);
            $table->foreign('id_pelanggan')->references('id_pelanggan')
            ->on('pelanggans')->onDelete('cascade')->nullable();
            $table->string('id_alatoutdoor',8);
            $table->foreign('id_alatoutdoor')->references('id_alatoutdoor')
            ->on('alatoutdoors')->onDelete('cascade');
            $table->string('jml_sewa',3);
            $table->string('total_sewa',6);
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
        Schema::dropIfExists('keranjangs');
    }
};
