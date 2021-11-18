<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircularsTable extends Migration
{
    public function up()
    {
        Schema::create('circulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('circular_type');
            $table->string('cirucular_name')->unique();
            $table->integer('circular_year')->nullable();
            $table->string('reference_number')->unique();
            $table->date('reference_date');
            $table->decimal('sec_stipend_amount', 15, 2);
            $table->decimal('hsec_stipend_amount', 15, 2);
            $table->decimal('hons_stipend_amount', 15, 2);
            $table->date('application_deadline');
            $table->date('institution_head_deadline')->nullable();
            $table->boolean('circular_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
