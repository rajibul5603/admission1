<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInstituteBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('institute_bank_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('banking_type_id')->nullable();
            $table->foreign('banking_type_id', 'banking_type_fk_4359544')->references('id')->on('banking_types');
            $table->unsignedBigInteger('bank_name_id')->nullable();
            $table->foreign('bank_name_id', 'bank_name_fk_4359547')->references('id')->on('banking_service_providers');
            $table->unsignedBigInteger('branch_name_id')->nullable();
            $table->foreign('branch_name_id', 'branch_name_fk_4359548')->references('id')->on('bank_branches');
            $table->unsignedBigInteger('routing_no_id')->nullable();
            $table->foreign('routing_no_id', 'routing_no_fk_4359549')->references('id')->on('bank_branches');
            $table->unsignedBigInteger('eiin_id')->nullable();
            $table->foreign('eiin_id', 'eiin_fk_4359550')->references('id')->on('educational_institutes');
        });
    }
}
