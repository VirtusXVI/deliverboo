<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('restaurant_name')->required();
            $table->string('email')->unique()->required();
            $table->string('password')->required();
            $table->string('address')->required();
            $table->unsignedBigInteger('p_iva')->unique()->required();
            $table->string('restaurant_image', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->rememberToken();
            $table->timestamps();
        });
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
