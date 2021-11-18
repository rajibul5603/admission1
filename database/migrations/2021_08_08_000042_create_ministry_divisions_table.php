<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistryDivisionsTable extends Migration
{
    public function up()
    {
        Schema::create('ministry_divisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ministry_name')->unique();
            $table->string('division_name')->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
