<?php

use Illuminate\Database\Seeder;
use App\Database;

class Database_antipoloSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $databases = [
            [
                'id'             => 1,
                'name' => 'Johnpaul Tanion'
            ],
            [
                'id'             => 2,
                'name' => 'Leane Veridiano'
            ],
            [
                'id'             => 3,
                'name' => 'Myleen Ortiz'
            ],
            [
                'id'             => 4,
                'name' => 'Kim Steven E. Claro'
            ],
            [
                'id'             => 5,
                'name' => 'Hilda Garcela'
            ],
            [
                'id'             => 6,
                'name' => 'Geneiva, Marlon E.'
            ],
            [
                'id'             => 7,
                'name' => 'Ralph Sumbillo'
            ],
            [
                'id'             => 8,
                'name' => 'Kaila Aniqa Canlas'
            ],
            [
                'id'             => 9,
                'name' => 'Irene Garcela'
            ],
            [
                'id'             => 10,
                'name' => 'Imery Garcela'
            ],
            [
                'id'             => 11,
                'name' => 'Mhelen  Garcela'
            ],
          
           
        ];

        Database::insert($databases);
    }
}
