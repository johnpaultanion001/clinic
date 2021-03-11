<?php

use Illuminate\Database\Seeder;
use App\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abouts = [
            [
                'id'             => 1,
                'title'           => 'History',
                'body'           => 'simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem',
            ],
            [
                'id'             => 2,
                'title'           => 'Vision',
                'body'           => 'A Preferred destination at the center of Calabarzon’s eastern growth corridor, with God – Cantered, Empowered and socially responsible citizenry living in sustainably- manage and safe environment having a globally competitive and progressive economy under an efficient and transparent leadership',
            ],
            [
                'id'             => 3,
                'title'           => 'Mission',
                'body'           => 'An efficient and transparent local government that is committed to the attainment of its vision and goals through: 
                                    <br/>
                                    <br/>
                                    1.	The creation of a favourable climate for local and foreign investor and tourists to ensure access to decent or quality job employment opportunities’ and stead revenue generation;
                                    <br/>
                                    2.	The protection, maintenance ,and rehabilitation of the physical environment;
                                    <br/>
                                    3.	The maximum utilization of antipolo’s competitive and advantages:
                                    <br/>
                                    4.	The development of a respectful, discipline, active, caring, and happy citizenry',
            ],
           
        ];

        AboutUs::insert($abouts);
    }
}
