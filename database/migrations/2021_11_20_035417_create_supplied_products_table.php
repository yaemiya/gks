<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplied_products', function (Blueprint $table) {
            $table->increments('supplier_product_id');
            $table->string('supplier_product_name', 30);
            $table->unsignedInteger('price');
            $table->string('unit', 5);
            $table->string('tax_rate', 1);
            $table->unsignedInteger('supplier_id');
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
        Schema::dropIfExists('supplied_products');
    }
}
