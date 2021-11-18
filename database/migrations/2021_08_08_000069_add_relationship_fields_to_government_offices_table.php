<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGovernmentOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('government_offices', function (Blueprint $table) {
            $table->unsignedBigInteger('ministry_name_id')->nullable();
            $table->foreign('ministry_name_id', 'ministry_name_fk_3874450')->references('id')->on('ministry_divisions');
        });
    }
}
