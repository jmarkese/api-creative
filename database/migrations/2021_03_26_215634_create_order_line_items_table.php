<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('order_line_items', function (Blueprint $table) {
            $table->id();
            $table->float('unit_price');
            $table->float('tax')->default(0);
            $table->float('shipping')->default(0);
            $table->float('discount')->default(0);
            $table->float('total');
            $table->unsignedBigInteger('qty');

            // these 3 should refer to some other tables, ie an fk shipping_id
            $table->boolean('flag_is_shipped')->default(false)->index();
            $table->string('tracking_number')->nullable();
            $table->string('shipping_agent')->nullable();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
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

        Schema::dropIfExists('order_line_items');

        Schema::enableForeignKeyConstraints();

    }
}
