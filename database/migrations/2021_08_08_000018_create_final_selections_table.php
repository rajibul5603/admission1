<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalSelectionsTable extends Migration
{
    public function up()
    {
        Schema::create('final_selections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_number');
            $table->string('user_id_no');
            $table->string('student_name');
            $table->string('brid');
            $table->string('father_name');
            $table->string('father_nid');
            $table->string('mother_name');
            $table->string('mother_nid');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
