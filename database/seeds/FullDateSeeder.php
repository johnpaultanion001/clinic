<?php

use Illuminate\Database\Seeder;
use App\FullDate;

class FullDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fulldate = [
            [
                'id'             => 1,
                'fulldate'   => 10,
            ],
        ];

        FullDate::insert($fulldate);
    }
}
