<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPayrollsTable extends Migration
{
    public function up()
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->unsignedBigInteger('circular_id');
            $table->foreign('circular_id', 'circular_fk_4365055')->references('id')->on('circulars');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_4365056')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_4365057')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_4365058')->references('id')->on('upazilas');
        });
    }
}
