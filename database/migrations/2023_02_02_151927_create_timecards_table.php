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
        Schema::create('timecards', function (Blueprint $table) {
            $table->bigIncrements('timecards_id');
            $table->unsignedBigInteger('student_id')->comment('รหัสนักเรียน');
            $table->date('c_date')->comment('วันที่');
            $table->time('c_in')->comment('เวลามาโรงเรียน');
            $table->time('c_out')->comment('เวลากลับบ้าน');
            $table->string('status')->comment('อื่นๆ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timecards');
    }
};
