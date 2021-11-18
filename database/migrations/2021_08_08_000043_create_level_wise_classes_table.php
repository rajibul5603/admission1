<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelWiseClassesTable extends Migration
{
    public function up()
    {
        Schema::create('level_wise_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
