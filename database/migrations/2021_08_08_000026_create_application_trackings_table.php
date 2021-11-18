<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTrackingsTable extends Migration
{
    public function up()
    {
        Schema::create('application_trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->unique();
            $table->boolean('is_completed')->default(0)->nullable();
            $table->boolean('is_submitted')->default(0)->nullable();
            $table->boolean('ih_seen')->default(0)->nullable();
            $table->boolean('ih_approve')->default(0)->nullable();
            $table->boolean('ih_forwarded')->default(0)->nullable();
            $table->boolean('useo_forwarded')->default(0)->nullable();
            $table->boolean('pmeat_accepted')->default(0)->nullable();
            $table->boolean('pmeat_selected')->default(0)->nullable();
            $table->string('rejection_reaseon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
