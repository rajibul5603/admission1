<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFamilyInfosTable extends Migration
{
    public function up()
    {
        Schema::table('family_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('application_number_id');
            $table->foreign('application_number_id', 'application_number_fk_4363325')->references('id')->on('general_infos');
            $table->unsignedBigInteger('familystatus_id');
            $table->foreign('familystatus_id', 'familystatus_fk_4363326')->references('id')->on('family_statuses');
            $table->unsignedBigInteger('guardian_occupation_id');
            $table->foreign('guardian_occupation_id', 'guardian_occupation_fk_4363327')->references('id')->on('occupations');
        });
    }
}
