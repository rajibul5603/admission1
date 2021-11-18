<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('payroll_id')->nullable();
            $table->foreign('payroll_id', 'payroll_fk_4365277')->references('id')->on('payrolls');
        });
    }
}
