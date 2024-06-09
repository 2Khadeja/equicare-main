
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
        Schema::create('data_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes(); // Agrega el campo para soft deletes
            // Agrega los campos adicionales del modelo DataBrands
            $table->string('name');
            $table->string('description');
            // ... Agrega más campos según tus necesidades
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_brands');
    }
};
