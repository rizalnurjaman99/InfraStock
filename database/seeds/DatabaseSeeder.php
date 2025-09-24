<?php

use App\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     */
    public function run(): void
    {
        User::create([
            "user_id" => "rizal123",
            "name" => "Rizal Nurjaman",
            "password" => Hash::make("123456"),       
        ]);

    }
}
