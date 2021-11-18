<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicYearsTable extends Migration
{
    public function up()
    {
        Schema::create('academic_years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academic_year')->unique();
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
