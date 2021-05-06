<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;

class EmployeesController extends Controller
{
    protected $empRepository;

    // public function __construct(EmployeeRepository $empRepository)
    // {
    //     $this->empRepository = $empRepository;
    // }

    // public function index()
    // {
    //     $employees = $this->empRepository->listAll();
    //     return view('employees.list',['employees'=>$employees]);
    // }
}
