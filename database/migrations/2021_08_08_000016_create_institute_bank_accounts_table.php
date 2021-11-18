<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('institute_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('account_name');
            $table->integer('account_number')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
