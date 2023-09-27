<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => '1',
            'name' => 'Commercial Property for Rent'
        ]);
        Category::create([
            'id' => '2',
            'name' => 'Commercial Property for Sale'
        ]);
        Category::create([
            'id' => '3',
            'name' => 'Houses & Apartments for Rent'
        ]);
        Category::create([
            'id' => '4',
            'name' => 'Houses & Apartments for Sale'
        ]);
        Category::create([
            'id' => '5',
            'name' => 'Land & Plots for Rent'
        ]);
        Category::create([
            'id' => '6',
            'name' => 'Land & Plots for Sale'
        ]);
        Category::create([
            'id' => '7',
            'name' => 'Short Let Property'
        ]);
    }
}
