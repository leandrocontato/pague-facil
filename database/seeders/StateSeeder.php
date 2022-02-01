<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $state = DB::table('state')->first();

        if(empty($state))
        {
            $states = file_get_contents("database/seeders/files/states.json");

            DB::table('state')->insert(json_decode($states, true));
        }
    }
}
