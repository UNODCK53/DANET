<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class MODTIERRAS_PROCESOINICIAL extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'MODTIERRAS_PROCESOINICIAL';
	public $timestamps = false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	

}