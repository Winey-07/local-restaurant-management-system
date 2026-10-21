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
               'id' => '6',
                'name'=> 'jin',
                'role'=>'staff',
                'email'=> 'example11@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '7',
                'name'=> 'ming',
                'role'=>'staff',
                'email'=> 'example@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '8',
                'name'=> 'seav',
                'role'=>'staff',
                'email'=> 'example1@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '9',
                'name'=> 'ing',
                'role'=>'staff',
                'email'=> 'example2@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '10',
                'name'=> 'ming',
                'role'=>'staff',
                'email'=> 'example3@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '11',
                'name'=> 'jing',
                'role'=>'staff',
                'email'=> 'example4@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '12',
                'name'=> 'ling',
                'role'=>'staff',
                'email'=> 'example5@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '13',
                'name'=> 'lily',
                'role'=>'staff',
                'email'=> 'example9@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '14',
                'name'=> 'na',
                'role'=>'staff',
                'email'=> 'example6@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '15',
                'name'=> 'sa',
                'role'=>'staff',
                'email'=> 'example7@gmail.com',
                'password'=>'123456789' 
            ],
            [
               'id' => '16',
                'name'=> 'reak',
                'role'=>'staff',
                'email'=> 'example8@gmail.com',
                'password'=>'123456789' 
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}