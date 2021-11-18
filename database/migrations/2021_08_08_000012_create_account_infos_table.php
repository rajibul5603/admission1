<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountInfosTable extends Migration
{
    public function up()
    {
        Schema::create('account_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user')->unique();
            $table->string('student_name');
            $table->string('routing_no')->unique();
            $table->string('bank_account_owner');
            $table->string('acc_name');
            $table->string('acc_no');
            $table->string('account_type')->nullable();
            $table->integer('account_holder_nid');
            $table->string('eiin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
