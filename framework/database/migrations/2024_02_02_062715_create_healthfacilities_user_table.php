<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthfcility_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('healthfcility_id');
            $table->unsignedBigInteger('user_id');
            // Add additional columns as needed
            $table->timestamps();

            // $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('healthfcility_user');
    }
};
