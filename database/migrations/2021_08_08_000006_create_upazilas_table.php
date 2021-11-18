<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilasTable extends Migration
{
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('upazila_name')->nullable();
            $table->string('upazila_name_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
