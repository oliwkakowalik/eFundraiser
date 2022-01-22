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
            'is_anonymous' => '0',
            'user_id' => '1',
            'fundraiser_id' => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '500',
            'description' => '...',
            'is_anonymous' => '0',
            'user_id' => '1',
            'fundraiser_id' => '1',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '200',
            'description' => 'Lubie pomagac',
            'is_anonymous' => '0',
            'user_id' => '2',
            'fundraiser_id' => '3',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '6000',
            'description' => 'Obyś wyzdrowiała',
            'is_anonymous' => '0',
            'user_id' => '2',
            'fundraiser_id' => '4',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '25000',
            'description' => 'To na pewno sprawka kosmitów',
            'is_anonymous' => '0',
            'user_id' => '3',
            'fundraiser_id' => '9',
            'created_at' => '2021-10-24 19:00:0'
        ]);

        DB::table('donations')->insert([
            'amount' => '100',
            'description' => 'Sorki, więcej nie mam',
            'is_anonymous' => '0',
            'user_id' => '5',
            'fundraiser_id' => '6',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '100000',
            'description' => 'Kto bogatemu zabroni',
            'is_anonymous' => '0',
            'user_id' => '7',
            'fundraiser_id' => '22',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '50',
            'description' => 'Liczy się gest',
            'is_anonymous' => '0',
            'user_id' => '8',
            'fundraiser_id' => '9',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '500',
            'description' => 'Miłej podróży',
            'is_anonymous' => '0',
            'user_id' => '7',
            'fundraiser_id' => '20',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '2000',
            'description' => 'Koszykówka the best!!!',
            'is_anonymous' => '0',
            'user_id' => '10',
            'fundraiser_id' => '14',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '500',
            'description' => 'Powodzenia',
            'is_anonymous' => '0',
            'user_id' => '10',
            'fundraiser_id' => '23',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '456.23',
            'description' => 'Obyś go używał do nauki',
            'is_anonymous' => '0',
            'user_id' => '11',
            'fundraiser_id' => '26',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '2123',
            'description' => 'Zapros do siebie Gawryli',
            'is_anonymous' => '0',
            'user_id' => '12',
            'fundraiser_id' => '25',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '200',
            'description' => 'Zgłaszam sie na aktora',
            'is_anonymous' => '0',
            'user_id' => '15',
            'fundraiser_id' => '11',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '1',
            'description' => 'Każda złotówka się liczy',
            'is_anonymous' => '0',
            'user_id' => '16',
            'fundraiser_id' => '19',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '2500',
            'description' => 'Ukradłem mamie, doceń to',
            'is_anonymous' => '0',
            'user_id' => '17',
            'fundraiser_id' => '10',
            'created_at' => "2022-11-04 19:00:0"
        ]);

        DB::table('donations')->insert([
            'amount' => '100',
            'description' => 'Może kiedyś uratujesz reprezentacje',
            'is_anonymous' => '0',
            'user_id' => '18',
            'fundraiser_id' => '15',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '200',
            'description' => 'Masz więcej, kup sobie kołdrę',
            'is_anonymous' => '0',
            'user_id' => '19',
            'fundraiser_id' => '27',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '250',
            'description' => 'Pozdrów Kim Dzong Una',
            'is_anonymous' => '0',
            'user_id' => '19',
            'fundraiser_id' => '19',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '200',
            'description' => 'Taki syn to skarb',
            'is_anonymous' => '0',
            'user_id' => '20',
            'fundraiser_id' => '18',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('donations')->insert([
            'amount' => '2022',
            'description' => 'Oby ten rok był lepszy od poprzedniego',
            'is_anonymous' => '0',
            'user_id' => '20',
            'fundraiser_id' => '20',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
    }
}
