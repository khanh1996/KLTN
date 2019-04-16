<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'code' => 'A25603',
            'name' => 'Văn Bảo Khánh',
            'birthday' => 1996,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 1,
        ]);
        DB::table('users')->insert([
            'code' => 'A11111',
            'name' => 'Văn Bảo Khánh 2',
            'birthday' => 1996,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 4,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI003',
            'name' => 'Phạm Thị Kim Hoa',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 1,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI008',
            'name' => 'Mai Thúy Nga',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 1,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI014',
            'name' => 'Trần Thị Huệ',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 1,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI006',
            'name' => 'Hà Thu Giang',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 1,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI010',
            'name' => 'Nguyễn Mạnh Hùng',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI011',
            'name' => 'Nguyễn Đức Dân',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI017',
            'name' => 'Cao Minh Khánh',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI018',
            'name' => 'Phạm Phương Thanh',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 1,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI019',
            'name' => 'Trần Quang Duy',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI021',
            'name' => 'Cao Kim Ánh',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI023',
            'name' => 'Nguyễn Công Điều',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI024',
            'name' => 'Vũ Như Lân',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI025',
            'name' => 'Nguyễn Thiện Luân',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI030',
            'name' => 'Hoàng Trọng Minh',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI033',
            'name' => 'Nguyễn Ngọc Tân',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI034',
            'name' => 'Nguyễn Đức Thắng',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
        DB::table('users')->insert([
            'code' => 'CTI035',
            'name' => 'Bùi Trường Giang',
            'birthday' => 2019,
            'password' => bcrypt('123456'),
            'gender' => 2,
            'role_id' => 2,
            'faculty_id' => 1,
            'department_id' => 8,
        ]);
    }
}
