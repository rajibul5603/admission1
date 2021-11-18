<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplineEducationalInstitutePivotTable extends Migration
{
    public function up()
    {
        Schema::create('discipline_educational_institute', function (Blueprint $table) {
            $table->unsignedBigInteger('educational_institute_id');
            $table->foreign('educational_institute_id', 'educational_institute_id_fk_3881979')->references('id')->on('educational_institutes')->onDelete('cascade');
            $table->unsignedBigInteger('discipline_id');
            $table->foreign('discipline_id', 'discipline_id_fk_3881979')->references('id')->on('disciplines')->onDelete('cascade');
        });
    }
}
