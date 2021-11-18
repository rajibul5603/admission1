<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('academic_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('level_name')->unique();
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
