<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'Giáo viên',
        ]);
        DB::table('roles')->insert([
            'name' => 'Sinh viên',
        ]);
        DB::table('roles')->insert([
            'name' => 'Thư ký',
        ]);
    }
}
