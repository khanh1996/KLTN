<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('tên đề tài');
            $table->tinyInteger('evaluate')->default(0)->comment('Đánh giá độ khó, dễ, bình thường đề tài');
            $table->longText('detail')->nullable()->comment('Mô tả khái quát về đề tài');
            $table->tinyInteger('status')->default(0)->comment('0 đề tài chưa được đăng ký, 1 là đề tài đã được đăng ký');
            $table->integer('department_id')->default(0)->comment('Khóa ngoại của bảng khoa - ngành');
            $table->integer('faculty_id')->default(0)->comment('Khóa ngoại của bảng khoa - ngành');
            $table->integer('user_id')->default(0)->comment('Khóa ngoại của bảng tài khoản');

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
        Schema::dropIfExists('subjects');
    }
}
