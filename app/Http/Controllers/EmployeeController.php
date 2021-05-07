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
    	$create = $this->empRepository->createEmployee($request->first_name, $request->last_name, $request->email, $request->role);
    	return json_encode($create);
    }

    public function show($id)
    {
    	//echo $id;
    }
}
