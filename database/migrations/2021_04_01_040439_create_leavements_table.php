<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leavements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');//daily=1 or hour=2
            $table->string('date_request');
            $table->tinyInteger('status')->default(0);//0=>prossesing , 1=> not accept,2=> accepted
            $table->string('start');
            $table->string('finish');
            $table->integer('date_count');
            $table->text('description');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leavements');
    }
}
