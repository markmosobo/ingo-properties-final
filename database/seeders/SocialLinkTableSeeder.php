<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialLink::create([
            'name' => 'Facebook',
            'link' => '',
            'status' => 0
        ]);

        SocialLink::create([
            'name' => 'Twitter',
            'link' => '',
            'status' => 0
        ]);

        SocialLink::create([
            'name' => 'Instagram',
            'link' => '',
            'status' => 0
        ]);

        SocialLink::create([
            'name' => 'Tiktok',
            'link' => '',
            'status' => 0
        ]);

        SocialLink::create([
            'name' => 'LinkedIn',
            'link' => '',
            'status' => 0
        ]);

        SocialLink::create([
            'name' => 'Youtube',
            'link' => '',
            'status' => 0
        ]);
    }
}
