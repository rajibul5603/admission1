<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnionsTable extends Migration
{
    public function up()
    {
        Schema::create('unions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('union_name');
            $table->string('union_name_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
