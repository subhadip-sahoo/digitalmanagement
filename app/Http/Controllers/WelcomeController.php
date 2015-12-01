<?php namespace App\Http\Controllers;
use Auth;
use App\Site;
use App\Receptionist;
use View;
use DB;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	
	public $site;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->site = Site::all()->first();
		View::share ( 'site', $this->site );
		/*$this->middleware('guest');*/
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check())
		{	
			if (Auth::user()->role_id == 1){
				$page_heading = "Receptionists";
				$editlink_controller = 'CommonController@editReceptionist';
				$users = DB::table('users')->where('users.role_id', '=', 3)->join('locations', 'users.location_id', '=', 'locations.id')->get(['users.*', 'locations.name']);
			}else{
				$page_heading = "Visitors";
				$editlink_controller = 'VisitorsController@edit';
				$users = DB::table('visitors')->join('locations', 'visitors.location', '=', 'locations.id')->get(['visitors.*', 'locations.name']);
			}
			
			return view('welcome', array('users' => $users, 'page_heading' => $page_heading, 'editlink_controller' => $editlink_controller));
		}else{
			return view('auth/login');
		}
	}

}
