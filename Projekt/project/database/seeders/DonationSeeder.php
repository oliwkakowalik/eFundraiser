<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fundraisers')->insert([
            'amount' => '3000',
            'description' => 'Kocham pieski',
            'is_anonymous' => '1',
            'when_donated' => '2022-01-23 15:00:00',
            'user_id' => '2',
            'fundraiser_id' => '1',
        ]);
    }
}
