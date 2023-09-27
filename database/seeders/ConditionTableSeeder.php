<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'id' => '1',
            'name' => 'Fairly Used'
        ]);

        Condition::create([
            'id' => '2',
            'name' => 'Newly-Built'
        ]);

        Condition::create([
            'id' => '3',
            'name' => 'Off-Plan'
        ]);

        Condition::create([
            'id' => '4',
            'name' => 'Old'
        ]);

        Condition::create([
            'id' => '5',
            'name' => 'Uncompleted building'
        ]);

        Condition::create([
            'id' => '6',
            'name' => 'Under construction'
        ]);
    }
}
