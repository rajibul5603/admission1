<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingServiceProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('banking_service_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('head_office')->nullable();
            $table->string('known_as');
            $table->string('swift_code')->nullable();
            $table->string('category')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
