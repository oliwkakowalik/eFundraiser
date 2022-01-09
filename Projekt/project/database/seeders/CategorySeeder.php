<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Charity',
        ]);

        DB::table('categories')->insert([
            'name' => 'Needs',
        ]);

        DB::table('categories')->insert([
            'name' => 'Projects',
        ]);

        DB::table('categories')->insert([
            'name' => 'Sport',
        ]);

        DB::table('categories')->insert([
            'name' => 'Presents',
        ]);

        DB::table('categories')->insert([
            'name' => 'Animals',
        ]);

        DB::table('categories')->insert([
            'name' => 'Travels',
        ]);

        DB::table('categories')->insert([
            'name' => 'Science',
        ]);

        DB::table('categories')->insert([
            'name' => 'Different',
        ]);
    }
}
