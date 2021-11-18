<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('government_offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('govt_ogranization_name')->unique();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
