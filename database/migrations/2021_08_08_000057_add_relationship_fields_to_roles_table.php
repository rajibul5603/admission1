<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRolesTable extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_category_id')->nullable();
            $table->foreign('user_category_id', 'user_category_fk_4371741')->references('id')->on('user_categories');
        });
    }
}
