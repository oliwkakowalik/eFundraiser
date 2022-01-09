<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Oliwia',
            'surname' => 'Kowalik',
            'email' => 'oliwia.kowalik@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Olga',
            'surname' => 'Śmistek',
            'email' => 'olga.smistek@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Krzysztof',
            'surname' => 'Żarnowski',
            'email' => 'krzysztof.zarnowski@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Damian',
            'surname' => 'Gortych',
            'email' => 'damian.gortych@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
