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
                    'name'           => 'Pre Natal',
                ],
                [
                    'id'             => 2,
                    'name'           => 'Maternity',
                ],
                [
                    'id'             => 3,
                    'name'           => 'Dental',
                ],
                [
                    'id'             => 4,
                    'name'           => 'Ent Checkup',
                ],
                [
                    'id'             => 5,
                    'name'           => 'Pediatric Checkup',
                ],
            ];
    
            Purpose::insert($purposes);
    }
}
