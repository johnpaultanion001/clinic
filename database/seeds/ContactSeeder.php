<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [
            [
                'id'             => 1,
                'title'           => 'FB Page',
                'body'           => 'https://www.facebook.com/HealthyPolo/',
            ],
            [
                'id'             => 2,
                'title'           => 'Contact Number',
                'body'           => '0911-1111-111',
            ],
            [
                'id'             => 3,
                'title'           => 'Email Address',
                'body'           => 'test@test.com',
            ],
            [
                'id'             => 4,
                'title'           => 'Location',
                'body'           => 'City Health Office M.Santos St. Brgy. San Roque,Antipolo City',
            ],
           
        ];

        Contact::insert($contacts);
    }
}
