<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('users', function($tabla) 
        {
            $tabla->increments('id');
            $tabla->string('username')->unique();
            $tabla->string('name');
            $tabla->string('last_name');
            $tabla->string('email');
            $tabla->integer('level');
            $tabla->integer('grupo');
            $tabla->integer('estado');
            $tabla->string('password');
            $tabla->string('entidad');
            $tabla->string('remember_token');
            $tabla->timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
