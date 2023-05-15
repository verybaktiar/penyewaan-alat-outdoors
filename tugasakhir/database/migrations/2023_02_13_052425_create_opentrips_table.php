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
        Schema::create('opentrips', function (Blueprint $table) {
            $table->string('id_opentrip',5)->primary();
            $table->string('nm_opentrip',25);
            $table->string('deskripsi',200);
            $table->string('fasilitas',100);
            $table->string('harga',10);
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
        Schema::dropIfExists('opentrips');
    }
};
