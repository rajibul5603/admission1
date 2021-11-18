<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyInfosTable extends Migration
{
    public function up()
    {
        Schema::create('family_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id_no');
            $table->string('guardian_education');
            $table->float('guardian_land', 15, 2);
            $table->decimal('guardian_annual_income', 15, 2);
            $table->integer('family_member')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
