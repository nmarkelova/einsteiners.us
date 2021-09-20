<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('active')->default('1');
            $table->string('link')->nullable();
            $table->foreignId('user_id')->constrained();

            $table->string('name');
            $table->string('cover_path', 2048)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_event')->nullable();
            $table->string('location')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('reviewed')->default('0');

            $table->timestamps();
        });

        DB::table('events')->insert([
            'name' => 'Event name',
            'link' => 'b316e9e3a9099758ea402b76c3c9c3dd',
            'cover_path' => 'upload/content/event.jpeg',
            'user_id'=> '1',
            'description' => 'On the other hand, the economic agenda of today is perfectly suited for the implementation of the economic feasibility of the decisions taken. In our desire to improve the user experience, we miss that representatives of modern social reserves are presented in an exceptionally positive light. Only some features of domestic policy are ambiguous and will be indicated as candidates for the role of key factors.',
            'date_event' => Carbon::tomorrow(),
            'location' => '2004 C Street #8, San Diego, CA 92102',
            'tags' => 'tags search'
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
