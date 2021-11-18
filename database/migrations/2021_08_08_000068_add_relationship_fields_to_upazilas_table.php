<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUpazilasTable extends Migration
{
    public function up()
    {
        Schema::table('upazilas', function (Blueprint $table) {
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_4348495')->references('id')->on('districts');
        });
    }
}
