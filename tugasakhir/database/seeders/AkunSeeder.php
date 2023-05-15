<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'id_user' => 'ADM001',
            'username' => 'admin',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin12345'),
            'role' => 'admin'
        ]
            ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
