<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThanasTable extends Migration
{
    public function up()
    {
        Schema::create('thanas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('thana_name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
