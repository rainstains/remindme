<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('privilege')->default('USER');
            $table->rememberToken();
            $table->timestamps();
        });
        // Insert user admin
        DB::table('users')->insert(
          array(
              'name' => 'rainstains',
              'email' => 'rainstains@remindme.com',
              'password' => Hash::make('adminx2'),
              'privilege' => 'ADMINme!',
              "created_at" =>  date('Y-m-d H:i:s'),
              "updated_at" => date('Y-m-d H:i:s'),
          )
        );
        DB::table('users')->insert(
          array(
              'name' => 'daffa',
              'email' => 'daffa@remindme.com',
              'password' => Hash::make('adminx2'),
              'privilege' => 'ADMINme!',
              "created_at" =>  date('Y-m-d H:i:s'),
              "updated_at" => date('Y-m-d H:i:s'),
          )
        );
        DB::table('users')->insert(
          array(
              'name' => 'jasmine',
              'email' => 'jasmine@remindme.com',
              'password' => Hash::make('adminx2'),
              'privilege' => 'ADMINme!',
              "created_at" =>  date('Y-m-d H:i:s'),
              "updated_at" => date('Y-m-d H:i:s'),
          )
        );
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
