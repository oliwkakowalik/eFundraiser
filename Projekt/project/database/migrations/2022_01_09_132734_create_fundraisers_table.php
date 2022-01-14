<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
CreateFundraisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('fundraisers', function (Blueprint $table) {
            $table->id();
            $table->float('amount_to_be_raised');
            $table->float('amount_raised');
            $table->timestamps();
            $table->timestamp('stop_date');
            $table->string('title');
            $table->text('description');
        });

        Schema::table('fundraisers', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('fundraisers', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fundraisers');
    }
}
