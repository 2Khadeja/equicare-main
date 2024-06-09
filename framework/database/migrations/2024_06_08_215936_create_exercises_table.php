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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->integer('healthfacility_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('traines_id')->nullable();
            $table->integer('recordequipment_id')->nullable();
            $table->text('note')->nullable();
            $table->string('type')->nullable();
            $table->string('condition_of_exercise')->nullable();
            $table->string('name_of_coach')->nullable();
            $table->string('phone_of_coach')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
    }
};
