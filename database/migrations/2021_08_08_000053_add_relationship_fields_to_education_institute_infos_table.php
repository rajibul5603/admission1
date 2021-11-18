<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEducationInstituteInfosTable extends Migration
{
    public function up()
    {
        Schema::table('education_institute_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('application_number_id');
            $table->foreign('application_number_id', 'application_number_fk_4363965')->references('id')->on('general_infos');
            $table->unsignedBigInteger('education_level_id');
            $table->foreign('education_level_id', 'education_level_fk_4363969')->references('id')->on('academic_levels');
            $table->unsignedBigInteger('class_name_id');
            $table->foreign('class_name_id', 'class_name_fk_4363970')->references('id')->on('level_wise_classes');
            $table->unsignedBigInteger('institute_name_id');
            $table->foreign('institute_name_id', 'institute_name_fk_4363971')->references('id')->on('educational_institutes');
            $table->unsignedBigInteger('eiin_id');
            $table->foreign('eiin_id', 'eiin_fk_4363972')->references('id')->on('educational_institutes');
            $table->unsignedBigInteger('last_study_class_id');
            $table->foreign('last_study_class_id', 'last_study_class_fk_4363973')->references('id')->on('level_wise_classes');
        });
    }
}
