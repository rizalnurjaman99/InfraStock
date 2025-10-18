<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // === Buat User ===
        $users = [
            ['user_id'=>'rizalnur','name'=>'Rizal Nurjaman','password'=>'123456'],
            ['user_id'=>'user02','name'=>'User 02','password'=>'123456'],
            ['user_id'=>'user03','name'=>'User 03','password'=>'123456'],
            ['user_id'=>'user04','name'=>'User 04','password'=>'123456'],
            ['user_id'=>'user05','name'=>'User 05','password'=>'123456'],
            ['user_id'=>'user06','name'=>'User 06','password'=>'123456'],
            ['user_id'=>'user07','name'=>'User 07','password'=>'123456'],
            ['user_id'=>'user08','name'=>'User 08','password'=>'123456'],
            ['user_id'=>'user09','name'=>'User 09','password'=>'123456'],
            ['user_id'=>'user10','name'=>'User 10','password'=>'123456'],
            ['user_id'=>'user11','name'=>'User 11','password'=>'123456'],
        ];

        foreach ($users as $u) {
            \App\User::updateOrCreate(
                ['user_id' => $u['user_id']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make($u['password']),
                ]
            );
        }

        // === Jalankan CategorySeeder ===
        $this->call(CategorySeeder::class);
    }
}
