<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEducationalInstitutesTable extends Migration
{
    public function up()
    {
        Schema::table('educational_institutes', function (Blueprint $table) {
            $table->unsignedBigInteger('legal_status_id')->nullable();
            $table->foreign('legal_status_id', 'legal_status_fk_4480848')->references('id')->on('institut_legal_statuses');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id', 'division_fk_4480854')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_4480855')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_4480856')->references('id')->on('upazilas');
            $table->unsignedBigInteger('union_id')->nullable();
            $table->foreign('union_id', 'union_fk_4480857')->references('id')->on('unions');
        });
    }
}
