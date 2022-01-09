<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundraiserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla piesków',
            'description' => 'Pomóż Nam uratować krakowskie schornisko dla psów "Kundelek"!',
            'user_id' => '1',
            'category_id' => '6',
            'start_date' => '2022-01-20 15:00:00',
            'stop_date' => '2022-02-20 15:00:0',
            'amount_to_be_raised' => '5000',
            'amount_raised' => '3000',
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla kotków',
            'description' => 'Pomóż Nam uratować krakowskie schornisko dla psów "Łapka"!',
            'user_id' => '1',
            'category_id' => '6',
            'start_date' => '2022-01-17 15:00:00',
            'stop_date' => '2022-03-20 15:00:0',
            'amount_to_be_raised' => '10000',
            'amount_raised' => '5450.45',
        ]);

    }
}
