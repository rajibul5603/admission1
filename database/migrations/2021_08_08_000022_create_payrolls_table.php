<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payroll_name');
            $table->integer('total_student');
            $table->string('financial_institutaion')->nullable();
            $table->decimal('total_assistance', 15, 2)->nullable();
            $table->decimal('total_disbursement', 15, 2)->nullable();
            $table->boolean('disbursement_status')->default(0);
            $table->date('activation_date')->nullable();
            $table->date('deactivation_date')->nullable();
            $table->string('api_key')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
