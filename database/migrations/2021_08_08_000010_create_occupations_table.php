<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationsTable extends Migration
{
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('occupation_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
