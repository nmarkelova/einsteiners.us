<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('active')->default('1');
            $table->foreignId('gender_id')->constrained();
            $table->foreignId('role_id')->constrained();

            $table->dateTime('past_paymant')->nullable();

            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            //$table->timestamp('phone_verifled_at');
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'gender_id' => '1',
            'role_id' => '1',
            'name' => 'Personal Name',
            'phone' => '+7(999)999-99-92',
            'email' => 'vendor@test.ru',
            'email_verified_at' => Carbon::tomorrow(),
            'password' => Hash::make(''),
        ]);

        DB::table('users')->insert([
            'gender_id' => '2',
            'role_id' => '2',
            'name' => 'Personal name',
            'phone' => '+7(999)999-99-91',
            'email' => 'private@test.ru',
            'email_verified_at' => Carbon::tomorrow(),
            'password' => Hash::make(''),
        ]);

        DB::table('users')->insert([
            'gender_id' => '1',
            'role_id' => '3',
            'name' => 'Admin',
            'phone' => '+1(999)999-99-99',
            'email' => 'info@einsteiners.net',
            'email_verified_at' => Carbon::tomorrow(),
            'password' => Hash::make(''),
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
