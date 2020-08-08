<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('yearMonth');
            $table->integer('totalSalary');
            $table->integer('basicSalary');
            $table->integer('overtimePay');
            $table->integer('healthInsurance');
            $table->integer('employeePension');
            $table->integer('employmentInsurance');
            $table->integer('incomeTax');
            $table->integer('residentTax');
            $table->integer('otherDeduction');
            $table->integer('totalDeduction');
            $table->integer('netIncome');
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
        Schema::dropIfExists('salaries');
    }
}
