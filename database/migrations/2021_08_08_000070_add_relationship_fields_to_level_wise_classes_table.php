<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLevelWiseClassesTable extends Migration
{
    public function up()
    {
        Schema::table('level_wise_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('academic_level_id')->nullable();
            $table->foreign('academic_level_id', 'academic_level_fk_3874845')->references('id')->on('academic_levels');
        });
    }
}
