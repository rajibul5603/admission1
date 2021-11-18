<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('bank_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branch_name');
            $table->string('branch_code')->nullable();
            $table->integer('routing_number')->unique();
            $table->longText('address')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('email')->nullable();
            $table->string('manager_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
