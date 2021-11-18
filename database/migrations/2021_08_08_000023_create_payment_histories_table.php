<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_number');
            $table->string('stu_name');
            $table->string('brid');
            $table->string('bank_acc_no');
            $table->string('bank_acc_name');
            $table->string('student_bank_name');
            $table->string('student_bank_branch');
            $table->string('bank_routing_no');
            $table->string('student_division');
            $table->string('student_district');
            $table->string('student_upazila');
            $table->float('pay_amount', 15, 2);
            $table->string('service_provider');
            $table->float('disbursement_amount', 15, 2);
            $table->date('disbursement_date');
            $table->string('disbursement_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
