<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUnionsTable extends Migration
{
    public function up()
    {
        Schema::table('unions', function (Blueprint $table) {
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_4348523')->references('id')->on('upazilas');
        });
    }
}
