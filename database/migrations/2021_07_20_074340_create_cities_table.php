<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('countrie_id')->constrained();
            $table->string('name');
            $table->timestamps();
        });
        $cities_name = [
            array('1','CitiMoscow'),
            array('1','CitiSaintPetersburg'),
            array('2','CitiNewYork'),
            array('2','CitiWashington'),
        ];
        foreach ($cities_name as $citie) {
            DB::table('cities')->insert([
                'countrie_id' => $citie[0],
                'name' => $citie[1]
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
        Schema::dropIfExists('cities');
    }
}
