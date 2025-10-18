<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Adjuro'],
            ['name' => 'Procurement'],
            ['name' => 'Beli Mandiri'],
            ['name' => 'Lainnya'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
