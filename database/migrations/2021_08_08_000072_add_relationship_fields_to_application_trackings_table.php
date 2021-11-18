<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToApplicationTrackingsTable extends Migration
{
    public function up()
    {
        Schema::table('application_trackings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_no_id');
            $table->foreign('user_id_no_id', 'user_id_no_fk_4516636')->references('id')->on('users');
        });
    }
}
