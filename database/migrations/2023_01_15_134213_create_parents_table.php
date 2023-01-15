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
        Schema::create('parents', function (Blueprint $table) {
            $table->id('parents_id');
            $table->string('prefix_name',20)->comment('คำนำหน้าชื่อ');
            $table->string('first_name',50)->comment('ชื่อ');
            $table->string('last_name',50)->comment('นามสกุล');
            $table->string('relationship',20)->comment('ความสัมพันธ์กับเด็ก');
            $table->string('job',50)->comment('อาชีพ');
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
        Schema::dropIfExists('parents');
    }
};
