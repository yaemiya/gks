<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopSalesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_sales_histories', function (Blueprint $table) {
            $table->increments('sph_id');
            $table->unsignedInteger('supplied_product_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('plant_id');
            $table->unsignedInteger('shop_id');
            $table->timestamp('sales_date');
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
        Schema::dropIfExists('shop_sales_histories');
    }
}
