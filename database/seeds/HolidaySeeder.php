<?php

use Illuminate\Database\Seeder;
use App\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $holidays = [
            [
                'id'             => 1,
                'name'           => 'Johnpaul Holiday',
                'date_holiday'   => '2021-03-19',
            ],
            [
                'id'             => 2,
                'name'           => 'Bday Ko',
                'date_holiday'   => '2021-03-21',
            ],
            [
                'id'             => 3,
                'name'           => 'Holiday',
                'date_holiday'   => '2021-03-22',
            ],
            [
                'id'             => 4,
                'name'           => 'Test Holiday',
                'date_holiday'   => '2021-03-24',
            ],
            [
                'id'             => 5,
                'name'           => 'Johnpauls Holiday',
                'date_holiday'   => '2021-03-23',
            ],
            
           
        ];

        Holiday::insert($holidays);
    }
}
