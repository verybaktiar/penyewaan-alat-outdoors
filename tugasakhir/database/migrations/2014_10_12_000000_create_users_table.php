<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_user',8)->primary();
            $table->string('username',25)->unique();
            $table->string('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'pelanggan']);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'id_user' => 'USR1',
            'username' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin'
        ]);

        User::create([
            'id_user' => 'USR2',
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin'
        ]);
        
        User::create([
            'id_user' => 'USR3',
            'username' => 'rida',
            'email' => 'ridaa@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'pelanggan'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
