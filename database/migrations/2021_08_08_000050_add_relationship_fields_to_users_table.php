<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_4348458')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_4348459')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_4348643')->references('id')->on('upazilas');
            $table->unsignedBigInteger('union_id')->nullable();
            $table->foreign('union_id', 'union_fk_4348644')->references('id')->on('unions');
        });
    }
}
