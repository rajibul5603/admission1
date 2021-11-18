<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('policy_name');
            $table->string('policy_year');
            $table->float('last_gpa', 15, 2)->nullable();
            $table->decimal('max_annual_income', 15, 2)->nullable();
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
