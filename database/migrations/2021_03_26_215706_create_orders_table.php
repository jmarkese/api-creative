<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ship_to_first_name');
            $table->string('ship_to_last_name');
            $table->string('ship_to_address_1');
            $table->string('ship_to_address_2')->nullable();
            $table->string('ship_to_postal_code');
            $table->string('ship_to_city');
            $table->string('ship_to_state');
            $table->string('ship_to_country');
            $table->string('bill_to_first_name');
            $table->string('bill_to_last_name');
            $table->string('bill_to_address_1');
            $table->string('bill_to_address_2')->nullable();
            $table->string('bill_to_postal_code');
            $table->string('bill_to_city');
            $table->string('bill_to_state');
            $table->string('bill_to_country');
            $table->boolean('flag_line_items_shipped')->default(false)->index();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('orders');

        Schema::enableForeignKeyConstraints();
    }
}
