<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('family_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status_name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
