<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrieSeeder::class,
            StateSeeder::class,
            CitieSeeder::class
        ]);
    }
}
