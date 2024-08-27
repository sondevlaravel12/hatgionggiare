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
            $table->id();
            $table->unsignedInteger('user_id')->nullable();

            $table->enum('status', ['pending', 'processing', 'completed', 'decline'])->default('pending');
            $table->integer('total')->unsigned();
            $table->unsignedInteger('item_count');

            $table->boolean('payment_status')->default(0);
            $table->string('payment_method')->nullable();

            $table->string('client_name');
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('phone_number');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('email')->nullable();
            $table->integer('discount')->unsigned()->nullable();



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
