<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Furnishing;

class FurnishingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Furnishing::create([
            'id' => '1',
            'name' => 'Furnished'
        ]);

        Furnishing::create([
            'id' => '2',
            'name' => 'Semi-Furnished'
        ]);

        Furnishing::create([
            'id' => '3',
            'name' => 'Unfurnished'
        ]);

    }
}
