<?php

use Illuminate\Database\Seeder;

class YearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('years')->insert([
            'name' => '2018',
        ]);
        DB::table('years')->insert([
            'name' => '2019',
        ]);
        DB::table('years')->insert([
            'name' => '2020',
        ]);
    }
}
