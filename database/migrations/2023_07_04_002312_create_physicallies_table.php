<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physically', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('รหัสนักเรียน')->default(0)->nullable();
            $table->string('semester',15)->comment('ภาคเรียนที่');
            $table->string('score_rate_physically',4)->comment('คะแนนรายด้าน')->default(0)->nullable();
            $table->string('table_no',11)->comment('เลขตาราง 1-10')->default(0)->nullable();
            $table->string('table_section',11)->comment('เลขหัวข้อในแต่ละตาราง เช่น 2.1');
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physicallies');
    }
};
