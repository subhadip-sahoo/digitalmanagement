<?php
namespace App\Http\Controllers;
use App\VisitorType;
use App\Site;
use Auth;
use Input;
use Redirect;
use Validator;
use View;
use DB;
use Response;
class VisitortypeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		return Response::json(VisitorType::get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$visitortype = new VisitorType;
		$visitortype->name = Input::get('name');
		$visitortype->save();
		
		return Response::json(array('success' => 'Visitor type has been added!'));
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
		return Response::json(VisitorType::find($id));
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
		$visitortype = VisitorType::findOrFail(Input::get('id'));
		$visitortype->name        = Input::get('name');
		$visitortype->save();
		
		return Response::json(array('success' => 'Visitor type has been updated!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		VisitorType::destroy($id);

		return Response::json(array('success' => 'Visitor type has been deleted!'));
	}

}