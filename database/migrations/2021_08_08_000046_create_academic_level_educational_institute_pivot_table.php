<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicLevelEducationalInstitutePivotTable extends Migration
{
    public function up()
    {
        Schema::create('academic_level_educational_institute', function (Blueprint $table) {
            $table->unsignedBigInteger('educational_institute_id');
            $table->foreign('educational_institute_id', 'educational_institute_id_fk_4480849')->references('id')->on('educational_institutes')->onDelete('cascade');
            $table->unsignedBigInteger('academic_level_id');
            $table->foreign('academic_level_id', 'academic_level_id_fk_4480849')->references('id')->on('academic_levels')->onDelete('cascade');
        });
    }
}
