<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAccountInfosTable extends Migration
{
    public function up()
    {
        Schema::table('account_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('app_number_id');
            $table->foreign('app_number_id', 'app_number_fk_4363991')->references('id')->on('general_infos');
            $table->unsignedBigInteger('banking_type_id');
            $table->foreign('banking_type_id', 'banking_type_fk_4515762')->references('id')->on('banking_types');
            $table->unsignedBigInteger('bank_name_id');
            $table->foreign('bank_name_id', 'bank_name_fk_4354773')->references('id')->on('banking_service_providers');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_4497451')->references('id')->on('districts');
            $table->unsignedBigInteger('bank_branch_id')->nullable();
            $table->foreign('bank_branch_id', 'bank_branch_fk_4354774')->references('id')->on('bank_branches');
            $table->unsignedBigInteger('branch_code_id')->nullable();
            $table->foreign('branch_code_id', 'branch_code_fk_4354776')->references('id')->on('bank_branches');
        });
    }
}
