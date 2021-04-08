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
            $table->increments('leavement_id');
            $table->integer('leavement_type');//daily or hour
            $table->string('leavement_date_request');
            $table->tinyInteger('leavement_status')->default(0);//0=>prossesing , 1=> not accept,2=> accepted
            $table->string('leavement_start');
            $table->string('leavement_finish');
            $table->integer('leavement_date_count');
            $table->text('leavement_description');
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
