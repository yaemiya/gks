<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processed_products', function (Blueprint $table) {
            $table->increments('processed_product_id');
            $table->string('processed_product_name', 30);
            $table->unsignedInteger('price');
            $table->string('unit', 5);
            $table->string('tax_rate', 1);
            $table->unsignedInteger('plant_id');
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
        Schema::dropIfExists('processed_products');
    }
}
