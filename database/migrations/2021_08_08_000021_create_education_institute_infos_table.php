<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationInstituteInfosTable extends Migration
{
    public function up()
    {
        Schema::create('education_institute_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institute_division');
            $table->string('institute_district');
            $table->string('institute_upazila');
            $table->float('last_gpa', 15, 2);
            $table->float('last_gpa_total', 15, 2);
            $table->string('user_id_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
