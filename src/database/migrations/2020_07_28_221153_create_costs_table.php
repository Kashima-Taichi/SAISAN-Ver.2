<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('accountName', 45);
            $table->string('accountAlpha', 45);
            $table->integer('price');
            $table->unsignedTinyInteger('dependency');
            $table->string('journal', 45);
            $table->integer('year');
            $table->integer('month');
            $table->integer('day');
            $table->date('date');
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
        Schema::dropIfExists('costs');
    }
}
