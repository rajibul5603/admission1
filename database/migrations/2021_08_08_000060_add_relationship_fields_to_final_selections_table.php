<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinalSelectionsTable extends Migration
{
    public function up()
    {
        Schema::table('final_selections', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_level_id');
            $table->foreign('academic_level_id', 'academic_level_fk_4360492')->references('id')->on('academic_levels');
            $table->unsignedBigInteger('admission_class_id');
            $table->foreign('admission_class_id', 'admission_class_fk_4360493')->references('id')->on('level_wise_classes');
            $table->unsignedBigInteger('education_institute_id')->nullable();
            $table->foreign('education_institute_id', 'education_institute_fk_4360507')->references('id')->on('educational_institutes');
            $table->unsignedBigInteger('eiin_id');
            $table->foreign('eiin_id', 'eiin_fk_4360495')->references('id')->on('selections');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id', 'division_fk_4360496')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id', 'district_fk_4360497')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id');
            $table->foreign('upazila_id', 'upazila_fk_4360498')->references('id')->on('upazilas');
        });
    }
}
