<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('active')->default('1');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('event_id')->constrained();

            $table->string('name');
            $table->string('cover_path', 2048)->nullable();
            $table->string('description')->nullable();
            $table->string('link_market')->nullable();

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
        Schema::dropIfExists('gifts');
    }
}
