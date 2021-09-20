<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('active')->default('1');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('task')->nullable();
            $table->string('email');
            $table->bigInteger('send')->default('0');
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
        Schema::dropIfExists('guests');
    }
}
