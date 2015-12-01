<?php
namespace App\Http\Controllers;

use App\Location;
use App\Site;
use Auth;
use Input;
use Redirect;
use Validator;
use View;
use DB;
use Response;
use App\Receptionist;
class ReceptionistController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = Location::all()->toArray();
		/*$receptionist = Receptionist::where('role_id', '=', 3)->get();*/
		$receptionist = DB::table('users')->where('users.role_id', '=', 3)->join('locations', 'users.location_id', '=', 'locations.id')->get(['users.*', 'locations.name as location']);
		return Response::json(array('allreceptionists'=>$receptionist,'locations'=>$locations));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		/*$rules = array(
			'first_name'	=> 'required',                        
			'last_name'		=> 'required',
			'email'			=> 'required|email',
			'location_id'		=> 'required',
			'password'		=> 'required|same:password_confirmation'
		);

		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Response::json(array('error' => $messages, 'success' => ''));
		} else {*/

			$data = Input::all();
			//echo "<pre>"; print_r($data['first_name']);die; 
			$receptionist = new Receptionist();
			/*$receptionist->first_name = Input::get('first_name');
			$receptionist->last_name = Input::get('last_name');
			$receptionist->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$receptionist->email = Input::get('email');
			$receptionist->location_id = Input::get('location_id');
			$receptionist->password = bcrypt(Input::get('password'));
			$receptionist->password_org = Input::get('password');*/
			$receptionist->first_name = $data['first_name'];
			$receptionist->last_name = $data['last_name'];
			$receptionist->name = $data['first_name'] . ' ' . $data['last_name'];
			$receptionist->email = $data['email'];
			$receptionist->location_id = $data['location_id'];
			$receptionist->password = $data['password'];
			$receptionist->password_org = $data['password'];
			$receptionist->status = 1;
			$receptionist->role_id = 3;
			
			if($receptionist->save()) {
				$filename = $data['attachFile'];
				$extension = substr(strrchr($filename,'.'),1);
				$imageName = $receptionist->id . '.' . $extension;
					
				$old_file = base_path() . '/public/uploads/avatar/' . $data['attachFile'];
				$new_file = base_path() . '/public/uploads/avatar/' . $imageName;
				$fileHand = fopen(base_path() . '/public/uploads/avatar/' . $data['attachFile'], 'r');
				fclose($fileHand);
				rename( $old_file, $new_file );
				$receptionist->avatar = $imageName;
				$receptionist->save();
				return Response::json(array('success' => 'Receptionist has been added!'));
				/*$avatar_val = Input::file('avatar');
				if(!empty($avatar_val)){
					$extension = Input::file('avatar')->getClientOriginalExtension();
					$imageName = $receptionist->id . '.' . $extension;
					$receptionist->avatar         = $imageName;			
					Input::file('avatar')->move(base_path() . '/public/uploads/avatar/', $imageName);
				}		
				return Response::json(array('success' => 'Receptionist has been added!'));*/
			}
		/*}*/
		
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
		return Response::json(Receptionist::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		/*$data = Input::all();
		echo "<pre>"; print_r($data);die;*/
		$receptionist = Receptionist::findOrFail(Input::get('id'));
		$receptionist->first_name        = Input::get('first_name');
		$receptionist->last_name           = Input::get('last_name');
		$receptionist->name = Input::get('first_name') . ' ' . Input::get('last_name');
		$receptionist->email                = Input::get('email');
		$receptionist->location_id = Input::get('location_id');
		/*$receptionist->password = bcrypt(Input::get('password'));
		$receptionist->password_org = Input::get('password');*/
		$receptionist->status                = 1;
		$receptionist->role_id                = 3;
		
		if(Input::get('attachFile')){
			$filename = Input::get('attachFile');
			$extension = substr(strrchr($filename,'.'),1);
			$imageName = Input::get('id') . '.' . $extension;
			$receptionist->avatar = $imageName;	
		}else{
			$receptionist->avatar = Input::get('avatar');
		}
		
		/*$avatar_val = Input::file('avatar');
		if(!empty($avatar_val)){
			$extension = Input::file('avatar')->getClientOriginalExtension();
			$imageName = Input::get('id') . '.' . $extension;							
			Input::file('avatar')->move(base_path() . '/public/uploads/avatar/', $imageName);				
			$receptionist->avatar         = $imageName;
		}*/
		
		$receptionist->save();
		return Response::json(array('success' => 'Receptionist has been updated!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Receptionist::destroy($id);

		return Response::json(array('success' => 'Receptionist has been deleted!'));
	}
	
	/*public function upload() {
		echo "<pre>"; print_r($_REQUEST); die;
		$extension = Input::file('avatar')->getClientOriginalExtension();
		$imageName = Input::get('id') . $extension;							
		Input::file('avatar')->move(base_path() . '/public/uploads/avatar/', $imageName);				
		
		return Response::json(array('success' => 'Upload successful!'));
	}*/

}