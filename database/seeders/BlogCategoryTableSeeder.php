<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::create([
            'id' => '1',
            'name' => 'Business'
        ]);

        BlogCategory::create([
            'id' => '2',
            'name' => 'Law'
        ]);

        BlogCategory::create([
            'id' => '3',
            'name' => 'Technology'
        ]);

        BlogCategory::create([
            'id' => '4',
            'name' => 'Housing'
        ]);
    }
}
