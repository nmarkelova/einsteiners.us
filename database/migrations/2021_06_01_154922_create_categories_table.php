<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $categories_name = [
            'CatShow',
            'CatCulture',
            'CatSport',
            'CatExcursions',
            'CatOnline',
        ];
        foreach ($categories_name as $categorie) {
            DB::table('categories')->insert([
                'name' => $categorie
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
        Schema::dropIfExists('categories');
    }
}
