<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use  App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => '1',
                'name'=> 'reaksa',
                'position'=>'admin',
                'password'=>'12345678'
            ],
            [
               'id' => '2',
                'name'=> 'reaksa',
                'position'=>'staff',
                'password'=>'123456789' 
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}