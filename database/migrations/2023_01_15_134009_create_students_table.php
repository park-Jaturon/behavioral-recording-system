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
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('student_id');
            $table->unsignedBigInteger('room_id')->comment('ห้อง')->default(0)->nullable();
            $table->unsignedBigInteger('parents_id')->comment('ผู้ปกครอง')->default(0)->nullable();
            $table->string('prefix_name',15)->comment('คำนำหน้าชื่อ');
            $table->string('first_name',50)->comment('ชื่อ');
            $table->string('last_name',50)->comment('นามสกุล');
            $table->string('birthdays',30)->comment('วันเกิด');
            $table->string('symbol',20)->comment('สัญลักษณ์');
            $table->tinyInteger('id_tags')->comment('รหัสประจำตัว')->default(0);
            $table->tinyInteger('number')->comment('เลขที่')->default(0);   
            $table->string('father',100)->comment('บิดา');
            $table->string('mother',100)->comment('มารดา');
            $table->tinyInteger('telephone_number_father')->comment('เบอร์โทรบิดา')->default(0)->nullable();
            $table->tinyInteger('telephone_number_mother')->comment('เบอร์โทรมารดา')->default(0)->nullable();
            $table->tinyInteger('telephone_number_bus')->comment('เบอร์โทรถรับส่ง')->default(0)->nullable();
            $table->text('habitations')->comment('ที่อยู่');
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
        Schema::dropIfExists('students');
    }
};
