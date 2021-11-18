<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDistrictsTable extends Migration
{
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->unsignedBigInteger('division_name_id');
            $table->foreign('division_name_id', 'division_name_fk_2691081')->references('id')->on('divisions');
        });
    }
}
