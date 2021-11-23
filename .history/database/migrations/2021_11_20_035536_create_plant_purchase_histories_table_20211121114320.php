<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantPurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_purchase_histories', function (Blueprint $table) {
            $table->increments('pph_id');
            $table->unsignedInteger('supplied_product_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('plant_id');
            $table->unsignedInteger('supplier_id');
            $table->timestamp('purchase_date');
            $table->string('delete_flag', 1);
            $table->timestamp('deleted_at')->useCu;
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
        Schema::dropIfExists('plant_purchase_histories');
    }
}
