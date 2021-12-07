<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSentimentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post', function (Blueprint $table) {
            $table->float('sentiment')->nullable();
        });
        Schema::table('chatcontent', function (Blueprint $table) {
            $table->float('sentiment')->nullable();
        });
        Schema::table('comment', function (Blueprint $table) {
            $table->float('sentiment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
