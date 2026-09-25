<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'phone' => '759509462',
            'phone_2' => '748925260',
            'email' => 'ingopropertymarketingkk@gmail.com',
            'address' => 'COURSEYARD BUSINESS CENTER, 
                        KAKAMEGA MUMIAS ROAD, 
                        KAKAMEGA. 
                        '
        ]);
    }
}
