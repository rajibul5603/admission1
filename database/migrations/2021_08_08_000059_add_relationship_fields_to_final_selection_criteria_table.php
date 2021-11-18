<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFinalSelectionCriteriaTable extends Migration
{
    public function up()
    {
        Schema::table('final_selection_criteria', function (Blueprint $table) {
            $table->unsignedBigInteger('cirular_id');
            $table->foreign('cirular_id', 'cirular_fk_4363168')->references('id')->on('circulars');
            $table->unsignedBigInteger('division_id');
            $table->foreign('division_id', 'division_fk_4363169')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id', 'district_fk_4363170')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id');
            $table->foreign('upazila_id', 'upazila_fk_4363171')->references('id')->on('upazilas');
        });
    }
}
