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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name', 100);
            $table->string('product_code', 20);
            $table->string('product_des', 500)->nullable();
            //$table->unsignedInteger('product_stock');

            $table->unsignedDecimal('product_price', 5, 2);
            $table->unsignedDecimal('product_saleprice', 5, 2);

            $table->string('product_imgcover', 100);
            $table->string('product_color', 10);
            $table->unsignedInteger('product_stock')->nullable();
            $table->unsignedInteger('product_stockleft')->nullable();
            $table->tinyInteger('product_status')->default('1');

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
        Schema::dropIfExists('products');
    }
};
