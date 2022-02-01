<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citie = DB::table('citie')->first();

        if(empty($citie))
        {
            $cities = file_get_contents("database/seeders/files/cities.json");

            DB::table('citie')->insert(json_decode($cities, true));
        }
    }
}
