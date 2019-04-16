<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAssemblysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_assemblys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position')->nullable()->comment('chú vụ của các thành viên trong hội đồng');
            $table->integer('weight')->default(0)->comment('trọng số ví dụ như 30% trên 100%');

            $table->integer('user_id')->comment('khóa ngoại của bảng user');
            $table->integer('assmebly_id')->comment('khóa ngoại của bảng hội đồng');

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
        Schema::dropIfExists('users_assemblys');
    }
}
