<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorRole extends Model {

	//use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'visitor_role';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['visitor_id', 'role_id'];

}
