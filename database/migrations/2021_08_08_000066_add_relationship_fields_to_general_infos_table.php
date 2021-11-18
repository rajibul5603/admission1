<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGeneralInfosTable extends Migration
{
    public function up()
    {
        Schema::table('general_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('circular_id');
            $table->foreign('circular_id', 'circular_fk_4363205')->references('id')->on('circulars');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id', 'division_fk_4353552')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id', 'district_fk_4353553')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id');
            $table->foreign('upazila_id', 'upazila_fk_4353554')->references('id')->on('upazilas');
            $table->unsignedBigInteger('union_id');
            $table->foreign('union_id', 'union_fk_4353555')->references('id')->on('unions');
        });
    }
}
