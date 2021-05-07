<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{
    protected $empRepository;

    public function __construct(EmployeeRepository $empRepository)
    {
        $this->empRepository = $empRepository;
    }

    public function index()
    {
        $employees = $this->empRepository->listAll();
        $result_data = array('data' => $employees);

        return response()->json(['data' => $employees], 200);
        //return view('welcome');
        //return view('employees.list',['employees'=>$employees]);
    }

    public function store(Request $request)
    {
    	$created = $this->empRepository->createEmployee($request->first_name, $request->last_name, $request->email, $request->role);

    	if($created){
    		return response()->json(['data' => $created], 200);
    	}

    	return response()->json(['error' => 'Employee not created'], 500);
    	
    }

    public function show($id)
    {
    	$employee = $this->empRepository->showEmployee($id);
    	if(!$employee){
    		return response()->json(['error' => 'Employee not found'], 404);
    	}
    	return response()->json(['data' => $employee], 200);
    }

    public function update($id, Request $request)
    {
    	$updated = $this->empRepository->updateEmployee($id, $request->first_name, $request->last_name, $request->email, $request->role);
    	if(!$updated){
    		return response()->json(['error' => 'Employee not found'], 404);
    	}
    	//for now returns emp id
    	return response()->json(['data' => $updated], 204);
    }

    public function destroy($id)
    {
    	$deleted = $this->empRepository->deleteEmployee($id);

    	if(!$deleted){
    		return response()->json(['error' => 'Employee not found or deleted'], 500);
    	}
    	
    	return response()->json(['data' => $deleted], 204);
    }

}
