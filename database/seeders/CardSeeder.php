<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citie = DB::table('card')->first();

        if(empty($card))
        {
            $card = file_get_contents("database/seeders/files/card.json");

            DB::table('card')->insert(json_decode($card, true));
        }
    }
}
