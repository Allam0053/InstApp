<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatcontentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatcontent', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('id_chat')->nullable();
            $table->foreign('id_chat')->references('id')->on('chat')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('pengirim')->nullable();
            $table->foreign('pengirim')->references('id')->on('users')->onDelete('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('chatcontent');
    }
}
