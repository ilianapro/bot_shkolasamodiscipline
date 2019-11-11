<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->date('dt');
            $table->string('user_id');
            $table->boolean('status')->nullable();
            $table->string('username')->nullable();
            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('leader')->nullable();
            $table->string('group');
            $table->dateTime('report1_dt')->nullable();
            $table->string('report1_photo_url')->nullable();
            $table->dateTime('report2_dt')->nullable();
            $table->longText('report2_tasks')->nullable();
            $table->dateTime('report3_dt')->nullable();
            $table->integer('report3_money')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
