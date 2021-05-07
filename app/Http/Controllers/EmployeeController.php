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
        return json_encode($employees);
        //return view('welcome');
        //return view('employees.list',['employees'=>$employees]);
    }

    public function store(Request $request)
    {
    	$created = $this->empRepository->createEmployee($request->first_name, $request->last_name, $request->email, $request->role);
    	return json_encode($create);
    }

    public function show($id)
    {
    	$employee = $this->empRepository->showEmployee($id);
    	return json_encode($employee);
    }

    public function update($id, Request $request)
    {
    	$updated = $this->empRepository->updateEmployee($id, $request->first_name, $request->last_name, $request->email, $request->role);
    	return json_encode($updated);
    }

}
