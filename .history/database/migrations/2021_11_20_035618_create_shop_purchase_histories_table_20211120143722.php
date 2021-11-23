<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopPurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_purchase_histories', function (Blueprint $table) {
            $table->increments('sph_id');
            $table->string('sph_tx_type', 1);
            $table->unsignedInteger('supplied_product_id');
            $table->unsignedInteger('processed_product_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('plant_id');
            $table->timestamp('purchase_date');
            $table->string('delete_flag', 1);
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('shop_purchase_histories');
    }
}
