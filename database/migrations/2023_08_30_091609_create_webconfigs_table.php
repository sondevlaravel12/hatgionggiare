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
        Schema::create('webconfigs', function (Blueprint $table) {
            $table->id();
            $table->longText('top_menu')->nullable();
            $table->longText('custom_css')->nullable();
            $table->longText('header_code')->nullable();
            $table->longText('body_code')->nullable();
            $table->boolean('contact_button')->nullable();
            $table->boolean('form_chat')->nullable();
            $table->longText('footer_code')->nullable();
            $table->text('site_cache')->nullable();
            $table->boolean('site_maintenance')->nullable();
            $table->string('product_tab_name')->nullable();
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
        Schema::dropIfExists('webconfigs');
    }
};
