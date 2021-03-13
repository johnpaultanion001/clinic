<?php

use Illuminate\Database\Seeder;
use App\Purpose;

class PurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $purposes = [
                [
                    'id'             => 1,
                    'name'           => 'General Check Up',
                ],
                [
                    'id'             => 2,
                    'name'           => 'Pre Natal',
                ],
                [
                    'id'             => 3,
                    'name'           => 'Maternity',
                ],
                [
                    'id'             => 4,
                    'name'           => 'Dental',
                ],
                [
                    'id'             => 5,
                    'name'           => 'Ent Checkup',
                ],
                [
                    'id'             => 6,
                    'name'           => 'Pediatric Checkup',
                ],
            ];
    
            Purpose::insert($purposes);
    }
}
