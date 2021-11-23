<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantShopRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_shop_relations', function (Blueprint $table) {
            $table->increments('ps_relation_id');
            $table->unsignedInteger('plant_id');
            $table->unsignedInteger('shop_id');
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
        Schema::dropIfExists('plant_shop_relations');
    }
}
