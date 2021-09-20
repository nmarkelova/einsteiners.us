<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $genders_name = [
            'male',
            'female',
        ];
        foreach ($genders_name as $gender) {
            DB::table('genders')->insert([
                'name' => $gender
            ]);
        };
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genders');
    }
}
