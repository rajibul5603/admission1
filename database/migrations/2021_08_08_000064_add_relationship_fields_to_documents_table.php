<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumentsTable extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('app_number_id')->nullable();
            $table->foreign('app_number_id', 'app_number_fk_4363812')->references('id')->on('general_infos');
        });
    }
}
