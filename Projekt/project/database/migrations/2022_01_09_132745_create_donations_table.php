<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->text('description');
            $table->boolean('is_anonymous');
            $table->timestamp('when_donated')->useCurrent();
        });

        Schema::table('donations', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('donations', function (Blueprint $table){
            $table->unsignedBigInteger('fundraiser_id');
            $table->foreign('fundraiser_id')->references('id')->on('fundraisers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
