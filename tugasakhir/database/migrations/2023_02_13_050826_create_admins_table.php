<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('id_admin',7)->primary();
            $table->string('id_user',8);
            $table->string('nama_admin',50);
            $table->string('alamat',100);
            $table->string('no_Telp',13);
            $table->foreign('id_user')->on('users')->references('id_user')->onDelete('cascade');
            $table->timestamps();
        });

        Admin::create([
            'id_admin' => 'ADM1',
            'id_user' =>  'USR1',
            'nama_admin' => 'Dinda Nisa',
            'alamat' => 'Surabaya',
            'no_Telp' => '085749252096'  
        ]);

        Admin::create([
            'id_admin' => 'ADM2',
            'id_user' =>  'USR2',
            'nama_admin' => 'Rengganis',
            'alamat' => 'Surabaya',
            'no_Telp' => '085607703475'  
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
