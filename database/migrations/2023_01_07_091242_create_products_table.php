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
            $table->id();
            // $table->string('catalog_id', 100)->nullable();
            // $table->string('name', 100)->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->integer('base_price')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('original_price')->nullable();

            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            // $table->text('video_link')->nullable();
            // $table->integer('view')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(1);
            // $table->string('sticky', 2)->nullable();
            // $table->integer('group')->nullable()->default(0);
            // $table->dateTime('create_date')->nullable();
            // $table->dateTime('update_date')->nullable();
            // $table->string('tag')->nullable();
            // $table->string('product_option', 100)->nullable()->comment('tùy chọn mua hàng, json text');
            // $table->integer('id2')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            // $table->integer('hvnet_product_id')->nullable();
            // $table->string('hot_cart');
            // $table->string('free_ship', 50)->nullable();
            // $table->string('quatang_id', 50)->nullable();
            // $table->string('product_type')->default('product');
            $table->tinyInteger('best_selling')->nullable()->default(0);
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
