<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalInstitutesTable extends Migration
{
    public function up()
    {
        Schema::create('educational_institutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_eiin_no')->unique();
            $table->string('institution_name');
            $table->string('institution_code')->nullable();
            $table->string('mpo_number')->nullable();
            $table->string('institute_head')->nullable();
            $table->string('email')->nullable();
            $table->integer('mobile_phone')->nullable();
            $table->integer('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
