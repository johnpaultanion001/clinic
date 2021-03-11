<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'admin@admin.com',
                'contact_number'           => '09123456212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'User',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'user@user.com',
                'contact_number'           => '09121456212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
