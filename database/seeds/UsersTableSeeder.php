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
                'name'           => 'User1',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'user1@user.com',
                'contact_number'           => '09121456212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'User2',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'user2@user.com',
                'contact_number'           => '09122456212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'User3',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'user3@user.com',
                'contact_number'           => '09151456212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'User4',
                'age'           => '21',
                'address'           => 'Antipolo City',
                'email'          => 'user4@user.com',
                'contact_number'           => '09121656212',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
