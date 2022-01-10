<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donations')->insert([
            'amount' => '3000',
            'description' => 'Kocham pieski',
            'is_anonymous' => '1',
            'user_id' => '2',
            'fundraiser_id' => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
    }
}
