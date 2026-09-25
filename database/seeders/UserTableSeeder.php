<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'role_id' => '1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'first_name' => 'Agent',
            'last_name' => 'One',
            'role_id' => '2',
            'email' => 'agent@agent.com',
            'password' => Hash::make('123456')
        ]);

        User::create([
            'first_name' => 'Buyer',
            'last_name' => 'One',
            'role_id' => '3',
            'email' => 'buyer@buyer.com',
            'password' => Hash::make('123456')
        ]);
    }
}
