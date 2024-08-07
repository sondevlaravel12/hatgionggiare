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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('header')->nullable();
            $table->string('header_css')->nullable();
            $table->string('big_text')->nullable();
            $table->string('big_text_css')->nullable();
            $table->string('short_description')->nullable();
            $table->string('short_description_css')->nullable();
            $table->string('call_to_action')->nullable();
            $table->string('call_to_action_css')->nullable();
            $table->string('link')->nullable();
            $table->text('type')->nullable();
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('sliders');
    }
};
