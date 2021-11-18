<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBankBranchesTable extends Migration
{
    public function up()
    {
        Schema::table('bank_branches', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_name_id');
            $table->foreign('bank_name_id', 'bank_name_fk_4503573')->references('id')->on('banking_service_providers');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id', 'district_fk_4503576')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_4503577')->references('id')->on('upazilas');
        });
    }
}
