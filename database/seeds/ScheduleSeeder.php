<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            [
                'id'             => 1,
                'user_id'        => 1,
                'date_time'      => '2021-03-10',
                'time'        => '9:40 AM',
                'purpose_id'          => 2,
                'isCancel'           => '0',
            ],
            [
                'id'             => 2,
                'user_id'        => 2,
                'date_time'      => '2021-03-09',
                'time'        => '8:40 AM',
                'purpose_id'     => 1,
                'isCancel'       => '0',
            ],
            [
                'id'             => 3,
                'user_id'        => 2,
                'date_time'      => '2021-03-11',
                'time'        => '4:40 PM',
                'purpose_id'          => 3,
                'isCancel'           => '0',
            ],
            [
                'id'             => 4,
                'user_id'        => 2,
                'date_time'      => '2021-03-16',
                'time'        => '3:40 PM',
                'purpose_id'          => 4,
                'isCancel'           => '0',
            ],
            [
                'id'             => 5,
                'user_id'        => 1,
                'date_time'      => '2021-03-15',
                'time'        => '2:40 PM',
                'purpose_id'          => 5,
                'isCancel'           => '0',
            ],
            [
                'id'             => 6,
                'user_id'        => 1,
                'date_time'      => '2021-03-25',
                'time'        => '1:40 PM',
                'purpose_id'          => 4,
                'isCancel'           => '0',
            ],
           
        ];

        Schedule::insert($schedules);
    }
}
