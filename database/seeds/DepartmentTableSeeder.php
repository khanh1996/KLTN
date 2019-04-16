<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            'name' => 'TOÁN - TIN',
        ]);

        DB::table('departments')->insert([
            'name' => 'KINH TẾ - QUẢN LÍ',
        ]);

        DB::table('departments')->insert([
            'name' => 'KHOA HỌC SỨC KHỎE',
        ]);

        DB::table('departments')->insert([
            'name' => 'NGOẠI NGỮ',
        ]);

        DB::table('departments')->insert([
            'name' => 'KHOA HỌC XÃ HỘI & NHÂN VĂN',
        ]);

        DB::table('departments')->insert([
            'name' => 'THANH NHẠC',
        ]);

        // toán - tin : 1
        DB::table('departments')->insert([
            'name' => 'Toán ứng dụng',
            'parent' => 1,
        ]);
        DB::table('departments')->insert([
            'name' => 'Khoa học máy tính',
            'parent' => 1,
        ]);
        DB::table('departments')->insert([
            'name' => 'Truyền thông và mạng máy tính',
            'parent' => 1,
        ]);
        DB::table('departments')->insert([
            'name' => 'Hệ thống thông tin',
            'parent' => 1,
        ]);
        // kinh tế - quản lí : 2
        DB::table('departments')->insert([
            'name' => 'Kế toán',
            'parent' => 2,
        ]);
        DB::table('departments')->insert([
            'name' => 'Tài chính - Ngân hàng',
            'parent' => 2,
        ]);
        DB::table('departments')->insert([
            'name' => 'Quản trị kinh doanh',
            'parent' => 2,
        ]);
        DB::table('departments')->insert([
            'name' => 'Quản trị dịch vụ du lịch - lữ hành',
            'parent' => 2,
        ]);
        // khoa học sức khỏe 3

        DB::table('departments')->insert([
            'name' => 'Điều dưỡng',
            'parent' => 3,
        ]);
        DB::table('departments')->insert([
            'name' => 'Y tế công cộng',
            'parent' => 3,
        ]);
        DB::table('departments')->insert([
            'name' => 'Dinh dưỡng',
            'parent' => 3,
        ]);
        DB::table('departments')->insert([
            'name' => 'Quản lý bệnh viện',
            'parent' => 3,
        ]);

        // ngoại ngữ 4
        DB::table('departments')->insert([
            'name' => 'Ngôn ngữ Anh',
            'parent' => 4,
        ]);
        DB::table('departments')->insert([
            'name' => 'Ngôn ngữ Trung Quốc',
            'parent' => 4,
        ]);
        DB::table('departments')->insert([
            'name' => 'Ngôn ngữ Nhật',
            'parent' => 4,
        ]);
        DB::table('departments')->insert([
            'name' => 'Ngôn ngữ Hàn',
            'parent' => 4,
        ]);
        // khoa học xã hội và nhân văn 5
        DB::table('departments')->insert([
            'name' => 'Việt Nam học',
            'parent' => 5,
        ]);
        DB::table('departments')->insert([
            'name' => 'Công tác xã hội',
            'parent' => 5,
        ]);

        // năng khiếu 6
        DB::table('departments')->insert([
            'name' => 'Thanh nhạc',
            'parent' => 6,
        ]);

    }
}
