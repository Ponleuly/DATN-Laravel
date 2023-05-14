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
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('campaign_name');
            $table->string('code');
            $table->unsignedInteger('discount_percentage')->nullable();
            $table->unsignedDecimal('discount_value')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('subcategory_id')->nullable();
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('categories_subcategories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('coupon_status')->nullable();

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
        Schema::dropIfExists('coupons');
    }
};
