<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('user_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_category')->unique();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
