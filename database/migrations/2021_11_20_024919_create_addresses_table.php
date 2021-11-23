<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('address_id');
            $table->string('postal_code1', 3);
            $table->string('postal_code2', 4);
            $table->string('prefecture', 4);
            $table->string('address', 50);
            $table->string('house_num', 10);
            $table->string('building', 50);
            $table->string('tel', 11);
            $table->string('email', 50);
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
        Schema::dropIfExists('addresses');
    }
}
