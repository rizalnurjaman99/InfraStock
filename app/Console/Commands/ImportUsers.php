<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;

class ImportUsers extends Command
{
    protected $signature = 'users:import {filename=users.csv}';
    protected $description = 'Import users from a CSV file located in storage/app';

    public function handle()
    {
        $filename = $this->argument('filename');
        $path = storage_path('app/' . $filename);

        if (!file_exists($path)) {
            $this->error("File not found: $path");
            return;
        }

        $this->info("Importing users from: $path");

        $file = fopen($path, 'r');
        $header = fgetcsv($file); // ambil header (user_id, name, email, password)

        $count = 0;

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);

            User::updateOrCreate(
                ['user_id' => $data['user_id']], // biar gak duplikat
                [
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'password' => Hash::make($data['password']),
                ]
            );

            $count++;
        }

        fclose($file);

        $this->info("Imported $count users successfully.");
    }
}
