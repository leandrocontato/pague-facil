<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CountrieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countrie = DB::table('countrie')->first();

        if(empty($countrie))
        {
            $countries = file_get_contents("database/seeders/files/countries.json");

            DB::table('countrie')->insert(json_decode($countries, true));
        }
    }
}
