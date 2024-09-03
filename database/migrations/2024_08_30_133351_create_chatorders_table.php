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
        Schema::create('chatorders', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->string('product')->nullable();
            $table->string('order_number')->nullable();
            $table->enum('status', ['pending','processing', 'decline','completed'])->nullable()->default('pending');
            $table->string('admin_notes')->nullable();
            $table->string('urltrangweb')->nullable();
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
        Schema::dropIfExists('chatorders');
    }
};
