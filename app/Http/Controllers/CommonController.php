<?php namespace App\Http\Controllers;
use App\User;
use App\Location;
use App\Site;
use App\Employee;
use App\Visitor;
use App\Receptionist;
use App\VisitorType;
use Auth;
use Input;
use Redirect;
use Validator;
use View;
use DB;
use Response;
use Session;

class CommonController extends Controller {

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
		Session::put('visitordata', '');
		$this->middleware('auth');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$visitorlocationid = Auth::user()->location_id;
		if (Auth::user()->role_id == 1){
			$page_heading = "Receptionists";
			$editlink_controller = 'CommonController@editReceptionist';
			$users = DB::table('users')->where('users.role_id', '=', 3)->join('locations', 'users.location_id', '=', 'locations.id')->get(['users.*', 'locations.name as location']);
			$u_type = 'r';
			
		}else{
			$page_heading = "Visitors";
			$arival_date = date('d-m-Y');
			$editlink_controller = 'VisitorsController@show';
			$users = DB::table('visitors')->where('location', '=', $visitorlocationid)->join('locations', 'visitors.location', '=', 'locations.id')->where('visitors.arival_date', '=', $arival_date)->get(['visitors.*', 'locations.name as location']);
			$u_type = 'v';
		}
		return Response::json(array('users' => $users, 
								'page_heading' => $page_heading, 
								'editlink_controller' => $editlink_controller,
								'u_type' => $u_type,
								'user_role' => Auth::user()->role_id));
			//return view('welcome', array('users' => $users, 'page_heading' => $page_heading, 'editlink_controller' => $editlink_controller));
		
	}
	
	/**
	 * Admin Handlers...
	 *
	 */
	public function admincontrol()
	{
		if(Auth::check())
		{	
			return view('admin');
		}else{
			return view('auth/login'); 
		}
	}
	
	public function editSiteinfo()
	{
		if(Auth::check())
		{
			$site = Site::all()->first();
			return view('siteinfo', compact('site'));
		}else{
			return view('auth/login');
		}
	}	
	public function handleEditSiteinfo()
	{
		$rules = array(
			'title'       => 'required',
			'logo'       => 'mimes:jpeg,bmp,png', //mimes:jpeg,bmp,png and for max size max:10000
			'terms_conditions'       => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Redirect::action('CommonController@editSiteinfo')
				->withErrors($validator)->withInput();
		} else {
			
			$site = Site::all()->first();
			if($site == null){
				$site = new Site;
			}			
			$site->title = Input::get('title');			
			$logo_val = Input::file('logo');
			if(!empty($logo_val)){
				$extension = Input::file('logo')->getClientOriginalExtension();
				$imageName = 'logo.' . $extension;							
				Input::file('logo')->move(base_path() . '/public/uploads/site/', $imageName);
				$site->logo = $imageName;
			}
			$site->terms_conditions = html_entity_decode(Input::get('terms_conditions'));
			$site->save();
			
			return Redirect::action('CommonController@admincontrol');
		
		}
		
	}
	
	/**
	 * Settings Handlers...
	 *
	 */
	public function settings()
	{
		$userId = Auth::id();
		$userData = User::where('id', '=', $userId)->get();
		return Response::json(array('userData' => (object)$userData)); 
	}
	/**
	 * Update the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateuser($id)
	{
		$rules = array(
			'first_name'       => 'required',                        
			'last_name'       => 'required',
			'email'            => 'required|email',
			'password' => 'same:confirm_password',
			'phone'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();
			return Response::json(array('error' => $messages, 'success' => ''));
		} else {

			$pass = Input::get('password');
			$userData = User::findOrFail(Input::get('id'));
			$userData->first_name        = Input::get('first_name');
			$userData->last_name        = Input::get('last_name');
			$userData->email        = Input::get('email');
			if(!empty($pass)){
				$userData->password        = bcrypt(Input::get('password'));
			}
			/*$userData->password_org        = Input::get('password_org');*/
			$userData->phone        = Input::get('phone');
			$userData->save();
			
			return Response::json(array('error' => '', 'success' => 'Successfully updated!'));
		}
	}
	
	/**
	 * Reports Handlers...
	 *
	 */
	public function reports()
	{
		$visitors = Visitor::all();
		return Response::json(array('visitors' => $visitors)); 
	}
	public function filterreports($reportData)
	{
		
		$report_data = json_decode($reportData, true);
		//print_r($report_data);die;
		/*$startDate = date("d-m-Y",strtotime($report_data['startDate']));
		$endDate = date("d-m-Y",strtotime($report_data['endDate']));*/
		
		/*if($report_data['startDate'] != ''){
			$startDate = strtotime(date("d-m-Y",strtotime($report_data['startDate'])));
		}else{
			$startDate = strtotime(date('d-m-Y'));
		}
		if($report_data['endDate'] != ''){
			$endDate = strtotime(date("d-m-Y",strtotime($report_data['endDate'])));
		}else{
			$endDate = strtotime(date('d-m-Y'));
		}*/
		
		$startDate = strtotime(date("d-m-Y",strtotime($report_data['startDate'])));
		$endDate = strtotime(date("d-m-Y",strtotime($report_data['endDate'])));
		
		$visitor_type = 0;
		if(isset($report_data['visitor_type'])){
			$visitor_type = $report_data['visitor_type'];
		}
		$visitor_host = 0;
		if(isset($report_data['visitor_host'])){
			$visitor_host = $report_data['visitor_host'];
		}
		$visitor_location = 0;
		if(isset($report_data['visitor_location'])){
			$visitor_location = $report_data['visitor_location'];
		}
		
		//echo date("d-m-Y",strtotime($report_data['startDate'])).' / '.date("d-m-Y",strtotime($report_data['endDate']));die;
		/*$visitors = DB::table('visitors')->where('visitors.arival_date', '>=', $startDate)->where('visitors.arival_date', '<=', $endDate)->join('users', 'visitors.host_name', '=', 'users.id')->join('locations', 'visitors.location', '=', 'locations.id')->join('visitor_role', 'visitors.id', '=', 'visitor_role.visitor_id')->join('visitor_types', 'visitor_role.role_id', '=', 'visitor_types.id')->get(['visitors.*', 'users.name as hostname', 'locations.name as location_name', 'visitor_types.name as visitor_type']);*/
		
		$visitorlocationid = Auth::user()->location_id;
		$query = DB::table('visitors')->where('visitors.arival_timestamp', '>=', $startDate)->where('visitors.arival_timestamp', '<=', $endDate)->join('users', 'visitors.host_name', '=', 'users.id')->join('locations', 'visitors.location', '=', 'locations.id')->join('visitor_role', 'visitors.id', '=', 'visitor_role.visitor_id')->join('visitor_types', 'visitor_role.role_id', '=', 'visitor_types.id');
		
		if (Auth::user()->role_id != 1)
			$query->where('visitors.location', '=', $visitorlocationid);
			
		if ($visitor_type != 0)
			$query->where('visitor_role.role_id', '=', $visitor_type);
			
		if ($visitor_location != 0)
			$query->where('visitors.location', '=', $visitor_location);
			
		if ($visitor_host != 0)
			$query->where('visitors.host_name', '=', $visitor_host);

		$visitors = $query->get(['visitors.*', 'users.name as hostname', 'locations.name as location_name', 'visitor_types.name as visitor_type']);
		
		return Response::json(array('visitors' => $visitors)); 
	}
	
	
	
	
	/**
	 * Location Handlers...
	 *
	 */
	public function locations()
	{
		
		// Show a listing of employees.
		if(Auth::check())
		{		
			$locations = Location::all();	
			return view('locations', compact('locations'));
		}else{
			return view('auth/login'); 
		}
	}
	public function createLocation()
	{
		if(Auth::check())
		{
			// Show the create employee form.
			return view('createlocation');
		}else{
			return view('auth/login');
		}
	}	
	public function handleCreateLocation()
	{
		// create the validation rules ------------------------
		$rules = array(
			'location_name'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@createLocation')
				->withErrors($validator)->withInput();

		} else {
			$location = new Location;
			$location->name = Input::get('location_name');
			$location->save();
			return Redirect::action('CommonController@locations');
		}
	}
	public function editLocation(Location $location)
    {
		if(Auth::check())
		{
			// Show the edit location form.
			return view('editlocation', compact('location'));
		}else{
			return view('auth/login');
		}
    }
	public function handleEditLocation()
    {
		// create the validation rules ------------------------
		$rules = array(
			'location_name'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@editLocation', Input::get('id'))
				->withErrors($validator)->withInput();

		} else {
			// Handle edit form submission.
			$location = Location::findOrFail(Input::get('id'));
			$location->name        = Input::get('location_name');
			$location->save();
			return Redirect::action('CommonController@locations');
		}
    }
	public function deleteLocation(Location $location)
    {
		if(Auth::check())
		{
		   // Show delete confirmation page.
			return view('deletelocation', compact('location'));
		}else{
			return view('auth/login');
		}
		
    }
	
	public function handleDeleteLocation()
    {
         // Handle the delete confirmation.
        $id = Input::get('location');
        $location = Location::findOrFail($id);
        $location->delete();
        return Redirect::action('CommonController@locations');
    }
	/**
	 * End of Location Controllers...
	 *
	 */
	
	/**
	 * Employee Handlers...
	 *
	 */
	public function employees()
	{
		
		// Show a listing of employees.
        //$employees = Employee::all();
		
		if(Auth::check())
		{		
			$employees = Employee::where('role_id', '=', 5)->get();		
			return view('employees', compact('employees'));
		}else{
			return view('auth/login'); 
		}
	}
	public function createEmployee()
	{
		if(Auth::check())
		{
			// Show the create employee form.
			$locations = Location::all();
			return view('createemployee', compact('locations'));
		}else{
			return view('auth/login');
		}
	}
	
	public function handleCreateEmployee()
	{
		// create the validation rules ------------------------
		$rules = array(
			'first_name'       => 'required',                        // just a normal required validation
			'last_name'       => 'required',
			'email'            => 'required|email|unique:users',
			'location'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@createEmployee')
				->withErrors($validator)->withInput();

		} else {
			$employee = new Employee;
			$employee->first_name = Input::get('first_name');
			$employee->last_name = Input::get('last_name');
			$employee->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$employee->email = Input::get('email');
			$employee->position = Input::get('position');
			$employee->phone = Input::get('phone');
			$employee->location_id = Input::get('location');
			$employee->status = 1;
			$employee->role_id = 5;
			$employee->save();
			return Redirect::action('CommonController@employees');
		}
	}
	public function editEmployee(Employee $employee)
    {
		if(Auth::check())
		{
			// Show the edit employee form.
			$locations = Location::all();
			return view('editemployee', compact('employee'), compact('locations'));
		}else{
			return view('auth/login');
		}
    }
	public function handleEditEmployee()
    {
		// create the validation rules ------------------------
		$rules = array(
			'first_name'       => 'required',                        // just a normal required validation
			'last_name'       => 'required',
			'email'            => 'required|email|unique:users,email,'.Input::get('id'),
			'location'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@editEmployee', Input::get('id'))
				->withErrors($validator)->withInput();

		} else {
			// Handle edit form submission.
			$employee = Employee::findOrFail(Input::get('id'));
			$employee->first_name        = Input::get('first_name');
			$employee->last_name           = Input::get('last_name');
			$employee->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$employee->email                = Input::get('email');
			$employee->position = Input::get('position');
			$employee->phone = Input::get('phone');
			$employee->location_id = Input::get('location');
			$employee->status                = 1;
			$employee->role_id                = 5;
			$employee->save();
			return Redirect::action('CommonController@employees');
		}
    }
	public function deleteEmployee(Employee $employee)
    {
		if(Auth::check())
		{
		   // Show delete confirmation page.
			return view('deleteemployee', compact('employee'));
		}else{
			return view('auth/login');
		}
		
    }	
	public function handleDeleteEmployee()
    {
         // Handle the delete confirmation.
        $id = Input::get('employee');
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return Redirect::action('CommonController@employees');
    }
	/**
	 * End of Employee Handlers...
	 *
	 */
	 
	/**
	 * Receptionists Handlers...
	 *
	 */
	public function receptionists()
	{
		
		// Show a listing of receptionists.
        //$receptionists = Receptionist::all();
		
		if(Auth::check())
		{		
			$receptionists = Receptionist::where('role_id', '=', 3)->get();		
			return view('receptionists', compact('receptionists'));
		}else{
			return view('auth/login'); 
		}
	}
	public function createReceptionist()
	{
		if(Auth::check())
		{
			// Show the create receptionist form.
			$locations = Location::all();
			return view('createreceptionist', compact('locations'));
		}else{
			return view('auth/login');
		}
	}
	
	public function handleCreateReceptionist()
	{
		// create the validation rules ------------------------
		$rules = array(
			'first_name'       => 'required',                        // just a normal required validation
			'last_name'       => 'required',
			'email'            => 'required|email|unique:users',
			'location'       => 'required',
			'password' => 'required|confirmed|min:6',
			'avatar'       => 'mimes:jpeg,bmp,png' //mimes:jpeg,bmp,png and for max size max:10000
			
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@createReceptionist')
				->withErrors($validator)->withInput();

		} else {
			
			$receptionist = new Receptionist;
			$receptionist->first_name = Input::get('first_name');
			$receptionist->last_name = Input::get('last_name');
			$receptionist->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$receptionist->email = Input::get('email');
			$receptionist->location_id = Input::get('location');
			$receptionist->password = bcrypt(Input::get('password'));
			$receptionist->status = 1;
			$receptionist->role_id = 3;
			$receptionist->save();
			
			if($receptionist->save()) {
				$avatar_val = Input::file('avatar');
				if(!empty($avatar_val)){
					$extension = Input::file('avatar')->getClientOriginalExtension();
					$imageName = $receptionist->id . '.' . $extension;
					$receptionist->avatar         = $imageName;			
					Input::file('avatar')->move(base_path() . '/public/uploads/avatar/', $imageName);
				}		
				return Redirect::action('CommonController@receptionists');
			}
		}
	}
	public function editReceptionist(Receptionist $receptionist)
    {
		if(Auth::check())
		{
			// Show the edit receptionist form.
			$locations = Location::all();
			return view('editreceptionist', compact('receptionist'), compact('locations'));
		}else{
			return view('auth/login');
		}
    }
	public function handleEditReceptionist()
    {
		// create the validation rules ------------------------
		$rules = array(
			'first_name'       => 'required',                        // just a normal required validation
			'last_name'       => 'required',
			'email'            => 'required|email|unique:users,email,'.Input::get('id'),
			'location'       => 'required',
			'avatar'       => 'mimes:jpeg,bmp,png' //mimes:jpeg,bmp,png and for max size max:10000
			
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@editReceptionist', Input::get('id'))
				->withErrors($validator)->withInput();

		} else {
			// Handle edit form submission.
			$receptionist = Receptionist::findOrFail(Input::get('id'));
			$receptionist->first_name        = Input::get('first_name');
			$receptionist->last_name           = Input::get('last_name');
			$receptionist->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$receptionist->email                = Input::get('email');
			$receptionist->location_id = Input::get('location');
			$receptionist->status                = 1;
			$receptionist->role_id                = 3;
			
			$avatar_val = Input::file('avatar');
			if(!empty($avatar_val)){
				$extension = Input::file('avatar')->getClientOriginalExtension();
				$imageName = Input::get('id') . '.' . $extension;							
				Input::file('avatar')->move(base_path() . '/public/uploads/avatar/', $imageName);				
				$receptionist->avatar         = $imageName;
			}
			
			$receptionist->save();
			return Redirect::action('CommonController@receptionists');
		}
    }
	public function deleteReceptionist(Receptionist $receptionist)
    {
		if(Auth::check())
		{
		   // Show delete confirmation page.
			return view('deletereceptionist', compact('receptionist'));
		}else{
			return view('auth/login');
		}
		
    }	
	public function handleDeleteReceptionist()
    {
         // Handle the delete confirmation.
        $id = Input::get('receptionist');
        $receptionist = Receptionist::findOrFail($id);
        $receptionist->delete();
        return Redirect::action('CommonController@receptionists');
    }
	/**
	 * End of Receptionists Handlers...
	 *
	 */
	 
	 /**
	 * Visitor Types Handlers...
	 *
	 */
	public function visitortypes()
	{
		if(Auth::check())
		{		
			$visitortypes = VisitorType::all();
			return view('visitortypes', compact('visitortypes'));
		}else{
			return view('auth/login'); 
		}
	}
	public function createVisitortype()
	{
		if(Auth::check())
		{
			return view('createvisitortype');
		}else{
			return view('auth/login');
		}
	}
	
	public function handleCreateVisitortype()
	{
		// create the validation rules ------------------------
		$rules = array(
			'name'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@createVisitortype')
				->withErrors($validator)->withInput();

		} else {
			$visitortype = new VisitorType;
			$visitortype->name = Input::get('name');
			$visitortype->save();
			return Redirect::action('CommonController@visitortypes');
		}
	}
	public function editVisitortype(VisitorType $visitortype)
    {
		if(Auth::check())
		{
			return view('editvisitortype', compact('visitortype'));
		}else{
			return view('auth/login');
		}
    }
	public function handleEditVisitortype()
    {
		// create the validation rules ------------------------
		$rules = array(
			'name'       => 'required'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('CommonController@editVisitortype', Input::get('id'))
				->withErrors($validator)->withInput();

		} else {
			// Handle edit form submission.
			$visitortype = VisitorType::findOrFail(Input::get('id'));
			$visitortype->name        = Input::get('name');
			$visitortype->save();
			return Redirect::action('CommonController@visitortypes');
		}
    }
	public function deleteVisitortype(VisitorType $visitortype)
    {
		if(Auth::check())
		{
		   // Show delete confirmation page.
			return view('deletevisitortype', compact('visitortype'));
		}else{
			return view('auth/login');
		}
		
    }	
	public function handleDeleteVisitortype()
    {
         // Handle the delete confirmation.
        $id = Input::get('visitortype');
        $visitortype = VisitorType::findOrFail($id);
        $visitortype->delete();
        return Redirect::action('CommonController@visitortypes');
    }
	/**
	 * End of visitor type Handlers...
	 *
	 */
	 
}
