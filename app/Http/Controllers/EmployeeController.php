<?php
namespace App\Http\Controllers;
use App\Employee;
use App\Site;
use App\UserListImport;
use Auth;
use Input;
use Redirect;
use Validator;
use View;
use DB;
use Response;
class EmployeeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Employee::where('role_id', '=', 5)->get());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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
		$employee->department = Input::get('department');
		$employee->extension_no = Input::get('extension_no');
		$employee->vehicle_no = Input::get('vehicle_no');
		$employee->save();
		
		return Response::json(array('success' => 'Employee has been added!'));
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
		return Response::json(Employee::find($id));
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
		$employee->department = Input::get('department');
		$employee->extension_no = Input::get('extension_no');
		$employee->vehicle_no = Input::get('vehicle_no');
		$employee->save();
		
		return Response::json(array('success' => 'Employee has been updated!'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Employee::destroy($id);

		return Response::json(array('success' => 'Employee has been deleted!'));
	}
	
	/**
	 * Remove the all the resources from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyall()
	{
		Employee::where('role_id', 5)->delete();

		return Response::json(array('success' => 'All Contacts has been deleted!'));
	}
	
	/**
	 * Import Employee Data.
	 *
	 */
	public function importUserList(UserListImport $import)
    {
        // get the results
        $results = $import->get();
		
		foreach($results as $result)
		{
			$employee = Employee::firstOrCreate(array('email' => $result['email']));
			$employee->first_name = $result['first_name'];
			$employee->last_name = $result['last_name'];
			$employee->name = $result['name'];
			$employee->position = $result['position'];
			$employee->phone = $result['phone'];
			$employee->location_id = $result['location_id'];
			$employee->status = $result['status'];
			$employee->role_id = $result['role_id'];
			$employee->department = $result['department'];
			$employee->extension_no = $result['extension_no'];
			$employee->vehicle_no = $result['vehicle_no'];
			$employee->save();
		}
		return Response::json(array('success' => 'Employee data successfully imported!'));
    }
	
}