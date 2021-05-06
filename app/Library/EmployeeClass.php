<?php

namespace App\Library;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;

use Kreait\Firebase\Factory;


class EmployeeClass implements EmployeeRepository
{

	protected $database;

    public function __construct()
    {
    	$factory = (new Factory)
    		->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
    		->withDatabaseUri('https://employee-crud-8da1a-default-rtdb.firebaseio.com/');
        $this->database = $factory->createDatabase();
    }

    public function createEmployee($first_name, $last_name, $email, $role){
    	$database = $this->database;
     	$emp_key = $database->getReference('users')->push()->getKey();
     	$random = mt_rand(100, 999);
     	$emp_id = $first_name[0].$last_name.$random;
  		$emp = new Employee($emp_id, $first_name, $last_name, $email, $role);

		$updates = [
		    'employees/'.$emp_key => $emp,
		];

		$database->getReference()->update($updates);
    }

    public function listAll()
    {
    	$database = $this->database;
    	//$this->createEmployee("jack", "jack", "jackjack@email.com", "developer");
     	$employees = $database->getReference('employees')->getValue();
     	echo "world";
     	print_r($employees);
  		
        //return Employee::all();
    }
}