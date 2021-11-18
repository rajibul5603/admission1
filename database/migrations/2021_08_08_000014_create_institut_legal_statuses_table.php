<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutLegalStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('institut_legal_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institute_legal_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
