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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('teacher_id');
            $table->string('prefix_name',20)->comment('คำนำหน้าชื่อ');
            $table->string('first_name',50)->comment('ชื่อ');
            $table->string('last_name',50)->comment('นามสกุล');
            $table->string('rank_teacher',20)->comment('ตำแหน่ง');
            $table->string('teacher_image')->comment('รูปครู');
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
        Schema::dropIfExists('teachers');
    }
};
