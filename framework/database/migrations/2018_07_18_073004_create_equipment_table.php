<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Record_equipment extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if(Schema::hasTable('record_equipment')){
            return;
        }
		Schema::create('record_equipment', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('short_name')->nullable();
			$table->string('user_id')->nullable();
			$table->integer('item_id')->nullable();
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
			$table->string('company')->nullable();
			$table->string('model')->nullable();
			$table->string('sr_no')->nullable();
			$table->string('unique_id')->unique()->nullable();
			$table->string('department')->nullable();
			$table->date('order_date')->nullable()->default(null);
			$table->date('date_of_purchase')->nullable()->default(null);
			$table->date('date_of_installation')->nullable()->default(null);
			$table->date('warranty_due_date')->nullable()->default(null);
			$table->string('service_engineer_no')->nullable();
			$table->boolean('is_critical')->nullable();
			$table->text('notes')->nullable();
			$table->string('qr_id')->nullable();
			$table->SoftDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('equipments');
	}
}
