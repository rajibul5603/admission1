<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToThanasTable extends Migration
{
    public function up()
    {
        Schema::table('thanas', function (Blueprint $table) {
            $table->unsignedBigInteger('district_name_id');
            $table->foreign('district_name_id', 'district_name_fk_2691879')->references('id')->on('districts');
        });
    }
}
