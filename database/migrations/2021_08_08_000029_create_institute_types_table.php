<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteTypesTable extends Migration
{
    public function up()
    {
        Schema::create('institute_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institute_type')->unique();
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
