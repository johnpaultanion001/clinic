<?php

use Illuminate\Database\Seeder;
use App\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedback = [
            [
                'id'             => 1,
                'name'   => "John Paul Tanion",
                'email'   => "JohnPaulTanion@test.com",
                'number'   => "12345678909",
                'msg'   => "testing",
            ],
        ];

        Feedback::insert($feedback);
    }
}
