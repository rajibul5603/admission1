<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCircularsTable extends Migration
{
    public function up()
    {
        Schema::table('circulars', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_year_id');
            $table->foreign('academic_year_id', 'academic_year_fk_3874333')->references('id')->on('academic_years');
            $table->unsignedBigInteger('policy_id');
            $table->foreign('policy_id', 'policy_fk_3923615')->references('id')->on('policies');
        });
    }
}
