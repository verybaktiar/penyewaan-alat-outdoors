<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pelanggan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->string('id_pelanggan',6)->primary();
            $table->string('id_user',8);
            $table->string('nama_pelanggan',50);
            $table->text('alamat',100)->nullable();
            $table->string('no_telepon',13)->nullable();
            $table->string('jenis_kelamin',15)->nullable();
            $table->foreign('id_user')->on('users')->references('id_user')->onDelete('cascade');
            $table->timestamps();
        });
    

    Pelanggan::create([
        'id_pelanggan' => 'PLG1',
        'id_user' => 'USR3',
        'nama_pelanggan' => 'rida',
        'no_telepon' => '085749252096',
        'jenis_kelamin' => 'perempuan',
    ]);
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
