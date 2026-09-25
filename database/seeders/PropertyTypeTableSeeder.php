<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::create([
            'id' => '1',
            'name' => 'Apartment',
        ]);
        PropertyType::create([
            'id' => '2',
            'name' => 'Bedsitter',
        ]);
        PropertyType::create([
            'id' => '3',
            'name' => 'Block of Flats',
        ]);
        PropertyType::create([
            'id' => '4',
            'name' => 'Bungalow',
        ]);
        PropertyType::create([
            'id' => '5',
            'name' => 'Chalet',
        ]);
        PropertyType::create([
            'id' => '6',
            'name' => 'Condo',
        ]);
        PropertyType::create([
            'id' => '7',
            'name' => 'Duplex',
        ]);
        PropertyType::create([
            'id' => '8',
            'name' => 'Farm House',
        ]);
        PropertyType::create([
            'id' => '9',
            'name' => 'House',
        ]);
        PropertyType::create([
            'id' => '10',
            'name' => 'Maisonette',
        ]);
        PropertyType::create([
            'id' => '11',
            'name' => 'Mansion',
        ]);
        PropertyType::create([
            'id' => '12',
            'name' => 'Mini Flat',
        ]);
        PropertyType::create([
            'id' => '13',
            'name' => 'Penthouse',
        ]);
        PropertyType::create([
            'id' => '14',
            'name' => 'Room & Parlour',
        ]);
    }
}
