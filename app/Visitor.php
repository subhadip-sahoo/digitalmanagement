<?php namespace App;

/*use Illuminate\Auth\Authenticatable;*/
use Illuminate\Database\Eloquent\Model;
/*use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;*/

class Visitor extends Model {

	//use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'visitors';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['card_no', 'title', 'first_name', 'last_name', 'email', 'company_name', 'host_name', 'location', 'arival_date', 'arival_time', 'arival_timestamp', 'avatar', 'status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['remember_token'];

}
