<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable()->comment('mã Sinh viên or giáo viên');
            $table->char('name')->nullable()->comment('tên tài khoản');
            $table->integer('birthday')->default(0);
            $table->string('password')->nullable()->comment('mật khẩu');
            $table->tinyInteger('gender')->default(0)->comment('giới tính');
            $table->string('class')->nullable()->comment('Lớp học');
            $table->string('course')->nullable()->comment('Khóa học ');
            $table->tinyInteger('group')->default(0)->comment(' học nhóm nào');
            $table->string('image')->nullable()->comment(' Ảnh của tài khoản');
            $table->string('email')->nullable()->comment(' Email của sinh viên or giáo viên');
            $table->string('phone')->nullable()->comment(' Điện thoai của sinh viên or giáo viên');
            $table->tinyInteger('status')->default(0)->comment('trạng thái của sinh viên 0 chưa đăng ký,1 đã đăng ký, 2 đã xác nhận bảo vệ,3 hoàn thành');

            $table->integer('department_id')->default(0)->comment(' khóa ngoại của bảng khoa - ngành');
            $table->integer('faculty_id')->default(0)->comment(' khóa ngoại của bảng khoa - ngành');
            $table->integer('role_id')->default(0)->comment('khóa ngoại của bảng quyền');

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
