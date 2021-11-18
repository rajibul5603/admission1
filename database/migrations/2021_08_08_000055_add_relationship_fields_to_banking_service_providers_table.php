<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankingServiceProvidersTable extends Migration
{
    public function up()
    {
        Schema::table('banking_service_providers', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_type_id');
            $table->foreign('bank_type_id', 'bank_type_fk_4514602')->references('id')->on('banking_types');
        });
    }
}
