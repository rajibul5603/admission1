<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingTypesTable extends Migration
{
    public function up()
    {
        Schema::create('banking_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banking_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
