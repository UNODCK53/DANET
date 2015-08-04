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
            $tabla->string('password');
            $tabla->string('name');
            $tabla->string('last_name');
            $tabla->string('empresa');
            $tabla->string('cargo');
            $tabla->string('email');
            $tabla->integer('grupo');
            $tabla->integer('level');
            $tabla->integer('estado');
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
