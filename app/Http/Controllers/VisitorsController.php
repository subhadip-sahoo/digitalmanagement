<?php namespace App\Http\Controllers;
use App\Visitor;
use App\VisitorType;
use App\VisitorRole;
use App\Location;
use App\Site;
use App\Employee;
use Auth;
use Input;
use Redirect;
use Validator;
use DB;
use View;
use Response;
use Image;
use Session;
//use Mail;

session_start();
class VisitorsController extends Controller {
	
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
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		Session::put('visitordata', '');
		// Show a listing of visitors.
		$user_role = Auth::user()->role_id;
		$visitorlocationid = Auth::user()->location_id;
		if($user_role == 1){
			$visitors = DB::table('visitors')->join('locations', 'visitors.location', '=', 'locations.id')->join('users', 'users.id', '=', 'visitors.host_name')->get(['visitors.*', 'locations.name', 'users.name as hostname']);
		}else{
			$visitors = DB::table('visitors')->where('location', '=', $visitorlocationid)->join('locations', 'visitors.location', '=', 'locations.id')->join('users', 'users.id', '=', 'visitors.host_name')->get(['visitors.*', 'locations.name', 'users.name as hostname']);
		}
        //$visitors = Visitor::all();
		return Response::json(array('visitors' => $visitors));		
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	
	public function create()
	{	
		if (Session::has('visitordata'))
		{
			$session_visitor = session('visitordata');
		}else{
			$session_visitor = '';
		}
		
		//print_r(session());die;
		//Session::put('visitordata', '');
		
		$card_no = str_random(4).date_timestamp_get(date_create());
		$arival_date = date('d-m-Y'); 
		$arival_time = date('H:i'); 
		$user_role = Auth::user()->role_id;
		$user_locationid = Auth::user()->location_id;
		$visitorlocationid = Auth::user()->location_id;
		$visitorlocation = Location::where('id', '=', $visitorlocationid)->pluck('name');
		if($user_role == 1){
			$visitors = DB::table('visitors')->join('locations', 'visitors.location', '=', 'locations.id')->join('visitor_role', 'visitors.id', '=', 'visitor_role.visitor_id')->join('visitor_types', 'visitor_role.role_id', '=', 'visitor_types.id')->join('users', 'users.id', '=', 'visitors.host_name')->get(['visitors.*', 'locations.name', 'visitor_types.name as visitor_type', 'users.name as visitor_host']);
		}else{
			$visitors = DB::table('visitors')->where('location', '=', $user_locationid)->where('arival_date', '=', $arival_date)->join('locations', 'visitors.location', '=', 'locations.id')->join('visitor_role', 'visitors.id', '=', 'visitor_role.visitor_id')->join('visitor_types', 'visitor_role.role_id', '=', 'visitor_types.id')->join('users', 'users.id', '=', 'visitors.host_name')->get(['visitors.*', 'locations.name', 'visitor_types.name as visitor_type', 'users.name as visitor_host']);
		}
		//echo "<pre>"; print_r($visitors);die;
		$visitortypes = VisitorType::all()->toArray();
		
		$current_visitors = DB::table('visitor_role')->join('visitors', 'visitors.id', '=', 'visitor_role.visitor_id')->where('visitors.status', '=', 1)->where('visitors.arival_date', '=', $arival_date)->get(['visitor_role.role_id']);
		
		$visitor_counts = array();
		foreach($visitortypes as $key=>$visitortype){
			$count = 0;
			$visitor_counts[$key]['visitortype'] = $visitortype['name'];
			foreach($current_visitors as $current_visitor){
				if($visitortype['id'] == $current_visitor->role_id){
					$count++;
				}
			}
			$visitor_counts[$key]['count'] = $count;
		}
		/*echo "<pre>"; print_r($visitor_counts);die;*/
		
		$employees = Employee::where('role_id', '=', 5)->get();
		
		return Response::json(array('visitors' => $visitors, 
									'visitortypes' => $visitortypes, 
									'hostnames' => $employees, 
									'location' => $visitorlocation, 
									'location_id' => $visitorlocationid, 
									'card_no' => $card_no,
									'arival_date' => $arival_date,
									'arival_time' => $arival_time, 
									'visitor_counts' => $visitor_counts,
									'session_visitor' => $session_visitor));											
		
	}
	public function resetvisitor()
	{
		Session::put('visitordata', '');
	}
	public function handleCreate()
	{
		//print_r(Input::get('arival_date'));die;
		$visitor = new Visitor;
		$visitor->card_no = Input::get('card_no');
		$visitor->title = Input::get('title');
		$visitor->first_name = Input::get('first_name');
		$visitor->last_name = Input::get('last_name');
		$visitor->email = Input::get('email');
		$visitor->company_name = Input::get('company_name');
		$visitor->host_name = Input::get('host_name');
		$visitor->location = Input::get('location_id');
		$visitor->arival_date = Input::get('arival_date');
		$visitor->arival_timestamp = strtotime(Input::get('arival_date'));
		$visitor->arival_time = Input::get('arival_time');
		$visitor->status = Input::get('status');
				
		if(strpos(Input::get('image_url'),'avatar/blank_face.jpg') !== false){
			$visitor->avatar = 0;
		}else{
			$image_name = $this->createimage(Input::get('image_url'), Input::get('card_no'));
			$visitor->avatar = 1;
			
		}
		
		if(Input::get('signature_url') != ""){
			$signature_name = $this->createsignatureimage(Input::get('signature_url'), Input::get('card_no'));
			$visitor->signature = 1;
		}else{
			$visitor->signature = 0;
		}
		
		/*$host_details = Employee::where('id', '=', Input::get('host_name'))->get();*/
		
		$hostname = Employee::where('id', '=', Input::get('host_name'))->pluck('name');
		$hostemail = Employee::where('id', '=', Input::get('host_name'))->pluck('email');
		
		if($visitor->save()) {
			$visitorRole = new VisitorRole;
			$visitorRole->visitor_id = $visitor->id;
			$visitorRole->role_id = Input::get('role_id');
			$visitorRole->save();
			
			/*Mail::send('Hii', function($message)
			{
				$message->from('suraj.samanta@businessprodesigns.com', 'Amaze Apps');
				$message->to('suraj.samanta@businessprodesigns.com')->subject('Visitor Meeting');
			});*/
			
			
			$message = "<html><head><title></title>
			<style>
			body, table {
					color: #2D2D2D;
					font-family: Tahoma,Geneva,sans-serif;
					font-size: 12px;
			}
			</style>
			</head><body>
			Dear " . $hostname . ",<br/><br/>
			Your visitor " . Input::get('title') . " " . Input::get('first_name') . " " . Input::get('last_name') . " from " . Input::get('company_name') . "  arrived at reception and waiting for your pre-scheduled meeting. <br/>
			This is for your information. <br /><br />";
			$message .= "Thanks,<br/>
					" . Auth::user()->name . "<br/>
					" . Location::where('id', '=', Auth::user()->location_id)->pluck('name') . "
					</body><html>";

			$subject = "Visitor Meeting";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= "From: Amaze Apps< " . Auth::user()->email . "  >";
			$to = $hostemail;
			$mail_sent = @mail( $to, $subject, $message, $headers );
			
			return Response::json(array('success' => 'Appointment has been done!'));
		}
	}
	public function getHostName($id)
	{
		$hostname = Employee::where('id', '=', $id)->pluck('name');
		return Response::json(array('hostname' => $hostname));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$visitor = DB::table('visitors')->where('visitors.id', '=', $id)->join('visitor_role', 'visitors.id', '=', 'visitor_role.visitor_id')->join('users', 'visitors.host_name', '=', 'users.id')->join('locations', 'locations.id', '=', 'visitors.location')->get(['visitors.*', 'visitor_role.role_id', 'users.name as hostname', 'locations.name as location_name']);
		
		Session::put('visitordata', $id);
		
		return Response::json((object)$visitor);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	
	public function edit(Visitor $visitor)
    {
		/*if(Auth::check())
		{
			$user_role = Auth::user()->role_id;
			$user_locationid = Auth::user()->location_id;
			$visitorlocationid = $visitor->location;
			$visitorlocation = Location::where('id', '=', $visitorlocationid)->pluck('name');
			if($user_role == 1){
				$visitors = DB::table('visitors')->join('locations', 'visitors.location', '=', 'locations.id')->get(['visitors.*', 'locations.name']);
			}else{
				$visitors = DB::table('visitors')->where('location', '=', $user_locationid)->join('locations', 'visitors.location', '=', 'locations.id')->get(['visitors.*', 'locations.name']);
			}
			$visitortypes = VisitorType::all();	
			$visitorrole = VisitorRole::where('visitor_id', '=', $visitor->id)->pluck('role_id');
			$employees = Employee::where('role_id', '=', 5)->get();	
			// Show the edit visitor form.
			return view('editappointment', array('visitor' => $visitor, 
												'visitors' => $visitors, 
												'visitortypes' => $visitortypes, 
												'visitorrole' => $visitorrole, 
												'hostnames' => $employees, 
												'location' => $visitorlocation, 
												'location_id' => $visitorlocationid));
		}else{
			return view('auth/login');
		}*/
    }
	public function handleEdit()
    {
		// create the validation rules ------------------------
		/*$rules = array(
			'card_no'       => 'required',
			'first_name'       => 'required',                        // just a normal required validation
			'last_name'       => 'required',
			'email'            => 'required|email'
		);

		// do the validation ----------------------------------
		// validate against the inputs from our form
		$validator = Validator::make(Input::all(), $rules);
		
		// check if the validator failed -----------------------
		if ($validator->fails()) {

			// get the error messages from the validator
			$messages = $validator->messages();

			// redirect our user back to the form with the errors from the validator
			return Redirect::action('VisitorsController@edit', Input::get('id'))
				->withErrors($validator)->withInput();

		} else {
			// Handle edit form submission.
			$visitor = Visitor::findOrFail(Input::get('id'));
			$visitor->card_no = Input::get('card_no');
			$visitor->title = Input::get('title');
			$visitor->first_name = Input::get('first_name');
			$visitor->last_name = Input::get('last_name');
			$visitor->email = Input::get('email');
			$visitor->company_name = Input::get('company_name');
			$visitor->host_name = Input::get('host_name');
			$visitor->location = Input::get('location_id');
			$visitor->arival_date = Input::get('arival_date');
			$visitor->arival_time = Input::get('arival_time');
			$visitor->status = 1;
			if($visitor->save()) {
				$visitorRole = VisitorRole::where('visitor_id', $visitor->id)->first();		
				if($visitorRole == null){
					$visitorRole = new VisitorRole;
				}
				$visitorRole->visitor_id = $visitor->id;
				$visitorRole->role_id = Input::get('visitor_type');
				$visitorRole->save();
				return Redirect::action('VisitorsController@index');
			}
		}*/
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Visitor $visitor)
	{
		Session::put('visitordata', '');
		//print "<pre>"; print_r($visitor);die;
		$visitor = Visitor::findOrFail(Input::get('id'));
		$visitor->card_no = Input::get('card_no');
		$visitor->title = Input::get('title');
		$visitor->first_name = Input::get('first_name');
		$visitor->last_name = Input::get('last_name');
		$visitor->email = Input::get('email');
		$visitor->company_name = Input::get('company_name');
		$visitor->host_name = Input::get('host_name');
		$visitor->location = Input::get('location');
		$visitor->arival_date = Input::get('arival_date');
		$visitor->arival_time = Input::get('arival_time');
		$visitor->arival_timestamp = strtotime(Input::get('arival_date'));
		$visitor->status = Input::get('status');
		
		$avatar_link = Input::get('image_url');
		if (strpos($avatar_link,'/') !== false) {
			$lastindex = strripos($avatar_link, "/");
			$stringlength = strlen($avatar_link);
			$avatar_link = substr($avatar_link, -($stringlength - $lastindex)+1);
		}
		
		if($avatar_link != "blank_face.jpg"){
			if($avatar_link != Input::get('card_no').'.jpg'){
				$image_name = $this->createimage(Input::get('image_url'), Input::get('card_no'));
			}
			$visitor->avatar = 1;
		}else{
			$visitor->avatar = 0;
		}
		/*print "<pre>"; print_r(Input::get('signature_url'));die;*/
		if(Input::get('signature_url') != ""){
			if(Input::get('signature_url') != Input::get('card_no').'_signature.jpg'){
				$signature_name = $this->createsignatureimage(Input::get('signature_url'), Input::get('card_no'));
			}			
			$visitor->signature = 1;
		}else{
			$visitor->signature = 0;
		}
		
		if($visitor->save()) {
			$visitorRole = VisitorRole::where('visitor_id', $visitor->id)->first();
			$visitorRole->role_id = Input::get('role_id');
			$visitorRole->save();
			/*Mail::send('Hii', function($message)
			{
				$message->from('suraj.samanta@businessprodesigns.com', 'Amaze Apps');
				$message->to('suraj.samanta@businessprodesigns.com')->subject('Visitor Meeting');
			});*/
						
			return Response::json(array('success' => 'Appointment updated successfully!', 'session_visitor' => ''));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Visitor::destroy($id);

		return Response::json(array('success' => 'Visitor has been deleted!'));
	}
	
	public function delete(Visitor $visitor)
    {
		if(Auth::check())
		{
		   // Show delete confirmation page.
			return view('deleteappointment', compact('visitor'));
		}else{
			return view('auth/login');
		}
		
    }
	
	public function handleDelete()
    {
         // Handle the delete confirmation.
        $id = Input::get('visitor');
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();
        return Redirect::action('VisitorsController@index');
    }
	
	public function createimage($data, $card_no)
	{
		$filePath = base_path() . '/public/uploads/avatar/' . $card_no . '.jpg';
		$imgData = str_replace(' ','+',$data);
		$imgData =  substr($imgData,strpos($imgData,",")+1);
		$imgData = base64_decode($imgData);
		$file = fopen($filePath, 'w');
		fwrite($file, $imgData);
		fclose($file);
		return $image_name = $card_no . '.jpg';
		//return Response::json(array('image_name' => $image_name));
	}
	public function createsignatureimage($data, $card_no)
	{
		$filePath = base_path() . '/public/uploads/avatar/' . $card_no . '_signature.jpg';
		$imgData = str_replace(' ','+',$data);
		$imgData =  substr($imgData,strpos($imgData,",")+1);
		$imgData = base64_decode($imgData);
		$file = fopen($filePath, 'w');
		fwrite($file, $imgData);
		fclose($file);
		return $image_name = $card_no . '.jpg';
	}
	public function statuschange($data)
	{
		$v_data = json_decode($data, true);
		$id = $v_data['id'];
		$status = $v_data['status'];
		$visitor = Visitor::findOrFail($id);
		$visitor->status = $status;
		if($status == 0){
			$visitor->departure_time = date('d-m-Y H:i:s');
		}else{
			$visitor->departure_time = '0000-00-00 00:00:00';
			$visitor->arival_date = date('d-m-Y'); 
			$visitor->arival_timestamp = strtotime(date('d-m-Y'));
			$visitor->arival_time = date('H:i'); 
		}
		if($visitor->save()) {
			return Response::json(array('success' => 'Status changed!'));
		}
	}
}