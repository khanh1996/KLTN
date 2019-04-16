<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGraduationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('time')->nullable()->comment(' thời gian đăng ký xác nhận bảo vệ KLTN');
            $table->string('room')->nullable()->comment('phòng để bảo vệ KLTN');
            $table->float('point')->default(0)->comment('điểm KLTN');
            $table->tinyInteger('status')->default(0)->comment('trạng thái đã đăng ký hoặc là đã xác nhận bảo vệ hoặc là hoàn thành');
            $table->tinyInteger('semester')->default(0)->comment('kỳ học như kỳ 1 or kỳ 2 ');
            $table->string('report')->nullable()->comment('bài báo cáo KLTN cá nhân');

            $table->integer('subject_id')->default(0)->comment('Khóa ngoại của bảng đề tài');
            $table->integer('year_id')->default(0)->comment('Khóa ngoại của bảng năm');
            $table->integer('user_student_id')->default(0)->comment('Khóa ngoại của bảng tài khoản');
            $table->integer('user_teacher_id')->default(0)->comment('Khóa ngoại của bảng tài khoản');
            $table->integer('assembly_id')->default(0)->comment('Khóa ngoại của bảng hội đồng');
            $table->integer('department_id')->default(0)->comment('Khóa ngoại của bảng khoa - ngành');
            $table->integer('faculty_id')->default(0)->comment('Khóa ngoại của bảng khoa - ngành');

            $table->integer('pointPresident')->default(0)->comment('Điểm của chủ tịch');
            $table->integer('pointSecretary')->default(0)->comment('Điểm của thư ký');
            $table->integer('pointCommissary')->default(0)->comment('Điểm của uy viên');
            $table->integer('pointReviewer')->default(0)->comment('Điểm của phản biện');

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
        Schema::dropIfExists('graduations');
    }
}
