<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->timestamps();
        });
        $countries_name = [
            array('CountRussia','RU'),
            array('CountUsa', 'USA'),
        ];
        foreach ($countries_name as $countrie) {
            DB::table('countries')->insert([
                'name' => $countrie[0],
                'code' => $countrie[1]
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
        Schema::dropIfExists('countries');
    }
}
