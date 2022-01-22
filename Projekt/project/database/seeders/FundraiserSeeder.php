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
            'title' => 'Na schronisko dla piesków',  // do usuniecia
            'description' => 'Zbiórka na schronisko dla psów **"Kundelek"**!',
            'user_id' => '2',
            'category_id' => '6',
            'stop_date' => '2022-02-20 15:00:0',
            'amount_to_be_raised' => '5000',
            'amount_raised' => '3000',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla kotków',
            'description' => 'Zbiórka na schronisko dla kotów **"Łapka"**!',
            'user_id' => '8',
            'category_id' => '6',
            'stop_date' => '2022-02-17 15:00:0',
            'amount_to_be_raised' => '10000',
            'amount_raised' => '5450.45',
            'created_at' => '2022-01-06 13:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na schronisko dla królików',
            'description' => 'Zbiórka na schronisko dla króilików',
            'user_id' => '9',
            'category_id' => '6',
            'stop_date' => '2022-03-11 15:00:0',
            'amount_to_be_raised' => '15000',
            'amount_raised' => '7450.45',
            'created_at' => '2022-01-01 13:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na leczenie dla Zosi',
            'description' => 'Zbiórka na leczenie dla Zosi.',
            'user_id' => '9',
            'category_id' => '1',
            'stop_date' => '2022-05-12 23:59:59',
            'amount_to_be_raised' => '100000',
            'amount_raised' => '45654.65',
            'created_at' => '2022-01-12 15:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Na leczenie dla Hani',
            'description' => 'Zbiórka na leczenie dla Hani.',
            'user_id' => '3',
            'category_id' => '1',
            'stop_date' => '2022-04-02 23:59:59',
            'amount_to_be_raised' => '13000',
            'amount_raised' => '3456.35',
            'created_at' => '2022-01-02 17:00:0'
        ]);


        DB::table('fundraisers')->insert([
            'title' => 'Na leczenie dla Johna',
            'description' => 'Zbiórka na leczenie dla Johna.',
            'user_id' => '10',
            'category_id' => '1',
            'stop_date' => '2022-04-12 23:59:59',
            'amount_to_be_raised' => '4000',
            'amount_raised' => '1576',
            'created_at' => '2022-01-07 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Odbudowa domu po pożarze',
            'description' => 'Zbiórka na odbudowe domu po pożarze.',
            'user_id' => '14',
            'category_id' => '2',
            'stop_date' => '2022-06-12 23:59:59',
            'amount_to_be_raised' => '300000',
            'amount_raised' => '228456.34',
            'created_at' => '2021-12-17 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Odbudowa domu po powodzi',
            'description' => 'Zbiórka na odbudowe domu po powodzi.',
            'user_id' => '15',
            'category_id' => '2',
            'stop_date' => '2022-04-12 23:59:59',
            'amount_to_be_raised' => '320000',
            'amount_raised' => '143256.34',
            'created_at' => '2021-11-17 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Odbudowa domu po udeżeniu meteorytu',
            'description' => 'Zbiórka na odbudowe domu po udeżeniu meteorytu.',
            'user_id' => '16',
            'category_id' => '2',
            'stop_date' => '2022-05-02 23:59:59',
            'amount_to_be_raised' => '500000',
            'amount_raised' => '354875.45',
            'created_at' => '2021-11-12 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Wydanie książki',
            'description' => 'Zbiórka na wydanie ksiązki.',
            'user_id' => '17',
            'category_id' => '3',
            'stop_date' => '2022-02-11 23:59:59',
            'amount_to_be_raised' => '5000',
            'amount_raised' => '1245',
            'created_at' => '2022-01-17 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Wydanie filmu',
            'description' => 'Zbiórka na wydanie filmu.',
            'user_id' => '18',
            'category_id' => '3',
            'stop_date' => '2022-05-28 23:59:59',
            'amount_to_be_raised' => '12000',
            'amount_raised' => '54322',
            'created_at' => '2022-01-21 19:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Wydanie czasopisma',
            'description' => 'Zbiórka na wydanie czasopisma.',
            'user_id' => '19',
            'category_id' => '3',
            'stop_date' => '2022-04-21 23:59:59',
            'amount_to_be_raised' => '1200',
            'amount_raised' => '7432',
            'created_at' => '2022-01-22 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Piłki do siatkówki',
            'description' => 'Zbiórka na piłki do siatkówki.',
            'user_id' => '20',
            'category_id' => '4',
            'stop_date' => '2022-04-21 23:59:59',
            'amount_to_be_raised' => '4000',
            'amount_raised' => '2345',
            'created_at' => '2022-01-19 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Piłki do koszykówki',
            'description' => 'Zbiórka na piłki do koszykówki.',
            'user_id' => '2',
            'category_id' => '4',
            'stop_date' => '2022-01-31 23:59:59',
            'amount_to_be_raised' => '1500',
            'amount_raised' => '345',
            'created_at' => '2022-01-02 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Piłki do piłki nożnej',
            'description' => 'Zbiórka na piłki do piłki nożnej.',
            'user_id' => '4',
            'category_id' => '4',
            'stop_date' => '2022-02-17 23:59:59',
            'amount_to_be_raised' => '4300',
            'amount_raised' => '1876',
            'created_at' => '2022-01-11 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Prezent dla mamy',
            'description' => 'Zbiórka na preznet dla mamy.',
            'user_id' => '5',
            'category_id' => '5',
            'stop_date' => '2022-02-19 23:59:59',
            'amount_to_be_raised' => '2000',
            'amount_raised' => '1345',
            'created_at' => '2022-01-13 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Prezent dla brata',
            'description' => 'Zbiórka na preznet dla brata.',
            'user_id' => '7',
            'category_id' => '5',
            'stop_date' => '2022-01-26 23:59:59',
            'amount_to_be_raised' => '12000',
            'amount_raised' => '10425',
            'created_at' => '2022-01-01 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Prezent dla taty',
            'description' => 'Zbiórka na prezent dla taty.',
            'user_id' => '6',
            'category_id' => '5',
            'stop_date' => '2022-03-19 23:59:59',
            'amount_to_be_raised' => '1200',
            'amount_raised' => '456',
            'created_at' => '2022-01-14 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Podróż do Chin',
            'description' => 'Zbiórka na podróż do Chin.',
            'user_id' => '7',
            'category_id' => '7',
            'stop_date' => '2022-04-26 23:59:59',
            'amount_to_be_raised' => '48000',
            'amount_raised' => '456',
            'created_at' => '2022-01-22 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Podróż do USA',
            'description' => 'Zbiórka na podróż do USA.',
            'user_id' => '9',
            'category_id' => '7',
            'stop_date' => '2022-03-16 23:59:59',
            'amount_to_be_raised' => '34000',
            'amount_raised' => '12000',
            'created_at' => '2021-12-02 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Podróż do Japoni',
            'description' => 'Zbiórka na podróż do Japoni.',
            'user_id' => '10',
            'category_id' => '7',
            'stop_date' => '2022-02-16 23:59:59',
            'amount_to_be_raised' => '32000',
            'amount_raised' => '23456',
            'created_at' => '2022-01-14 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Badania',
            'description' => 'Zbiórka na przeprowadzenie badań naukowych.',
            'user_id' => '11',
            'category_id' => '8',
            'stop_date' => '2022-02-16 23:59:59',
            'amount_to_be_raised' => '500000',
            'amount_raised' => '340234',
            'created_at' => '2021-05-23 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Eksperymenty',
            'description' => 'Zbiórka na przeprowadzenie eksperymentów naukowych.',
            'user_id' => '12',
            'category_id' => '8',
            'stop_date' => '2022-03-18 23:59:59',
            'amount_to_be_raised' => '238000',
            'amount_raised' => '123432',
            'created_at' => '2021-08-20 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Wynalazek',
            'description' => 'Zbiórka na wynalazek.',
            'user_id' => '13',
            'category_id' => '8',
            'stop_date' => '2022-01-29 23:59:59',
            'amount_to_be_raised' => '600000',
            'amount_raised' => '1872',
            'created_at' => '2021-12-23 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Studio nagraniowe',
            'description' => 'Zbiórka na studio nagraniowe.',
            'user_id' => '15',
            'category_id' => '9',
            'stop_date' => '2022-03-03 23:59:59',
            'amount_to_be_raised' => '61000',
            'amount_raised' => '34212',
            'created_at' => '2021-12-04 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Komputer',
            'description' => 'Zbiórka na komputer.',
            'user_id' => '14',
            'category_id' => '9',
            'stop_date' => '2022-02-26 23:59:59',
            'amount_to_be_raised' => '8000',
            'amount_raised' => '1832',
            'created_at' => '2021-12-25 11:00:0'
        ]);

        DB::table('fundraisers')->insert([
            'title' => 'Koc',
            'description' => 'Zbiórka na koc.',
            'user_id' => '15',
            'category_id' => '9',
            'stop_date' => '2022-01-31 23:59:59',
            'amount_to_be_raised' => '80',
            'amount_raised' => '12',
            'created_at' => '2022-01-02 11:00:0'
        ]);
    }
}
