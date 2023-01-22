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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug')->nullable();;
            $table->unsignedBigInteger('user_id')->default(0);
            $table->longText('description')->nullable();;
            $table->text('excerpt')->nullable();;
            $table->integer('status')->default(1);
            $table->enum('type', ['post', 'page', 'news', 'faq'])->default('post');
            $table->integer('category_id')->nullable();
            $table->integer('hot')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
