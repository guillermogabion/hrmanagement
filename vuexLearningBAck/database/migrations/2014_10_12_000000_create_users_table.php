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
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('mid_name');
            $table->string('profile_picture')->nullable();
            $table->string('birth_date');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('person_to_contact');
            $table->string('to_contact_number');
            $table->string('user_type');
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
