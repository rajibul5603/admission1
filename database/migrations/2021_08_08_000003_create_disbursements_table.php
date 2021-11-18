<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_number')->unique();
            $table->string('stu_name');
            $table->string('brid');
            $table->string('acc_no');
            $table->string('acc_name');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('routing_no');
            $table->string('student_division');
            $table->string('student_district');
            $table->string('student_upazila');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
