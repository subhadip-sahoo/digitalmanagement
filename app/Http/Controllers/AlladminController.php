<?php
namespace App\Http\Controllers;
use App\User;
use App\Site;
use Auth;
use Input;
use Redirect;
use Validator;
use View;
use DB;
use Response;
class AlladminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(User::where('role_id', '=', 1)->get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'first_name'	=> 'required',                        
			'last_name'		=> 'required',
			'email'			=> 'required|email',
			'password'		=> 'required|same:password_confirmation'
		);

		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Response::json(array('error' => $messages, 'success' => ''));
		} else {
			$alladmin = new User();
			$alladmin->first_name = Input::get('first_name');
			$alladmin->last_name = Input::get('last_name');
			$alladmin->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$alladmin->email = Input::get('email');
			$alladmin->password = bcrypt(Input::get('password'));
			$alladmin->status = 1;
			$alladmin->role_id = 1;
			$alladmin->save();
			
			return Response::json(array('success' => 'Admin has been added successfully!'));
		}
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
		return Response::json(User::find($id));
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
		$rules = array(
			'first_name'	=> 'required',                        
			'last_name'		=> 'required',
			'email'			=> 'required|email',
			'password'		=> 'same:password_confirmation'
		);

		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			$messages = $validator->messages();
			return Response::json(array('error' => $messages, 'success' => ''));
		} else {
			$alladmin = User::findOrFail(Input::get('id'));
			$alladmin->first_name        = Input::get('first_name');
			$alladmin->last_name           = Input::get('last_name');
			$alladmin->name = Input::get('first_name') . ' ' . Input::get('last_name');
			$alladmin->email                = Input::get('email');
			$alladmin->location_id = Input::get('location_id');
			$pass = Input::get('password');
			if(!empty($pass)){
				$alladmin->password = bcrypt(Input::get('password'));
			}
			$alladmin->status                = 1;
			$alladmin->role_id                = 1;
			$alladmin->save();
			
			return Response::json(array('success' => 'Admin has been updated successfully!'));
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
		User::destroy($id);

		return Response::json(array('success' => 'Admin has been deleted!'));
	}

}