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
        Schema::create('behaviors', function (Blueprint $table) {
            $table->bigIncrements('behavior_id');
            $table->unsignedBigInteger('student_id')->comment('รหัสนักเรียน');
            $table->string('type')->comment('ประเภท');
            $table->string('description')->comment('คำอธิบาย');
            $table->string('url_images')->comment('รูปคำอธิบาย');
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
        Schema::dropIfExists('behaviors');
    }
};
