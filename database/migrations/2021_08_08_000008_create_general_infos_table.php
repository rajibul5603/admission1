<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInfosTable extends Migration
{
    public function up()
    {
        Schema::create('general_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id_no');
            $table->string('application_no')->unique();
            $table->string('grants_name');
            $table->string('brid')->unique();
            $table->string('nid')->nullable();
            $table->string('name');
            $table->string('father_name');
            $table->integer('father_nid')->nullable();
            $table->string('mother_name');
            $table->integer('mother_nid')->nullable();
            $table->date('dob');
            $table->integer('age');
            $table->string('gender')->nullable();
            $table->string('village');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
