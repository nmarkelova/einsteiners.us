<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $paides_name = [
            'PaiFree',
            'PaiPaid',
        ];
        foreach ($paides_name as $paide) {
            DB::table('paides')->insert([
                'name' => $paide
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
        Schema::dropIfExists('paides');
    }
}
