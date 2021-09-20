<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover_path', 2048)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_event')->nullable();
            $table->string('age')->default('0+');
            $table->string('location')->nullable();
            $table->timestamps();
        });

        DB::table('calendars')->insert([
            'name' => 'Event name',
            'cover_path' => 'upload/content/event.jpeg',
            'description' => 'Thus, diluted with a fair amount of empathy, rational thinking allows you to assess the importance of timely completion of a super task. Modern technologies have reached such a level that the innovative path we have chosen directly depends on the distribution of internal reserves and resources. Only the key features of the project structure are objectively considered by the relevant authorities.',
            'date_event' => Carbon::tomorrow(),
            'age' => '6+',
            'location' => 'location plase',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
