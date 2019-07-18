<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_employments', function (Blueprint $table) {
            $table->integer('employment_id')->unsigned();
            $table->integer('employee_id');            
          
            $table->primary('employment_id', 'employee_id');
            $table->unique('employment_id', 'employee_id');
            $table->foreign('employment_id')->references('id')->on('employments')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_employments');
    }
}
