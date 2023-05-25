<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_code');
            $table->string('order_status');
            /*$table->foreign('order_status')
                ->references('id')
                ->on('orders_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            */
            $table->unsignedDecimal('discount');
            $table->unsignedDecimal('delivery_fee');
            $table->unsignedDecimal('total_paid')->nullable();
            $table->string('payment_method');
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
