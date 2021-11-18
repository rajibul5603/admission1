<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionsTable extends Migration
{
    public function up()
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('app_number')->unique();
            $table->string('user')->unique();
            $table->string('ih_comments');
            $table->string('ih_approval');
            $table->string('ih_submission');
            $table->string('useo_approval');
            $table->string('useo_submission');
            $table->string('pmeat_comments');
            $table->string('pmeat_approval');
            $table->string('eiin');
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
