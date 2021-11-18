<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('agreements')->insert([
            'name' => 'Waiver and Release of Liability',
            'cover_path' => 'upload/agreement/WaiverAndReleaseOfLiability.pdf',
        ]);
        DB::table('agreements')->insert([
            'name' => 'Covid 19 - Health Screening Form',
            'cover_path' => 'upload/agreement/COVID-19HealthScreeningForm.pdf',
        ]);
        DB::table('agreements')->insert([
            'name' => 'Covid 19 - Waiver',
            'cover_path' => 'upload/agreement/COVID-19LiabilityWaiver.pdf',
        ]);
        DB::table('agreements')->insert([
            'name' => 'Photo release',
            'cover_path' => 'upload/agreement/PhotoRelease.pdf',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreements');
    }
}
