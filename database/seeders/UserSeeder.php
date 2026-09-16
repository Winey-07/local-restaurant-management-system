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
                'password'=>'123456789' 
            ],
            [
               'id' => '7',
                'name'=> 'ming',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '8',
                'name'=> 'seav',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '9',
                'name'=> 'ing',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '10',
                'name'=> 'ming',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '11',
                'name'=> 'jing',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '12',
                'name'=> 'ling',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '13',
                'name'=> 'lily',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '14',
                'name'=> 'na',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '15',
                'name'=> 'sa',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
            [
               'id' => '16',
                'name'=> 'reak',
                'role'=>'staff',
                'password'=>'123456789' 
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}