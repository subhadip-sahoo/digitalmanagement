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
class LocationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		return Response::json(Location::get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$location = new Location;
		$location->name = Input::get('name');
		$location->save();
		
		return Response::json(array('success' => 'Location has been added!'));
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
		return Response::json(Location::find($id));
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
		$location = Location::findOrFail(Input::get('id'));
		$location->name        = Input::get('name');
		$location->save();
		
		return Response::json(array('success' => 'Location has been updated!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Location::destroy($id);

		return Response::json(array('success' => 'Location has been deleted!'));
	}

}