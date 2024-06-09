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
        Schema::create('record_equipment', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->nullable();
            // $table->integer('equipment_id')->nullable();
            $table->integer('accessory_id')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('guarante_id')->nullable();
            // $table->integer('stor_id')->nullable();
            $table->integer('equipment_id')->nullable();
            $table->string('serialnumber')->nullable();
            $table->string('model')->nullable();
            $table->string('code')->nullable();
            $table->string('company')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('recordequipment');
    }
};
