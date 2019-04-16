<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssemblysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assemblys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->comment('tên của hội đồng');
            $table->tinyInteger('status')->default(0)->comment('trạng thái tạo hội doongdfd là 1, thiết lập hội đồng là 2');

            $table->integer('year_id')->default(0)->comment('tên của năm');
            $table->integer('department_id')->default(0)->comment('tên của khoa - ngành');
            $table->integer('faculty_id')->default(0)->comment('tên của khoa - ngành');

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
        Schema::dropIfExists('assemblys');
    }
}
