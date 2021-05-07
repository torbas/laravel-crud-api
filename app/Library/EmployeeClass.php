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
     	$emp_key = $database->getReference('employees')->push()->getKey();
     	$random = mt_rand(100, 999);
     	$emp_id = $first_name[0].$last_name.$random;
  		$emp = new Employee($emp_id, $first_name, $last_name, $email, $role);

  		$ref = 'employees/'.$emp_key;
		$updates = [
		    $ref => $emp,
		];

		$database->getReference()->update($updates);
		//check it exists after created
		$exists = $database->getReference($ref)->getSnapshot()->exists();

		return $exists;
    }

    public function listAll()
    {
    	$database = $this->database;

     	$employees = $database->getReference('employees')->getValue();
     	return $employees;
    }

    public function showEmployee($id){
    	$database = $this->database;

     	$employee = $database->getReference('employees')
     				 ->orderByChild('id')
     				 ->equalTo($id)
     				 ->getSnapshot()
     				 ->getValue();

     	//if not found send false		 
     	if(empty($emp)){
     		return false;
     	}

     	return $employee;
    }


    public function updateEmployee($id, $first_name, $last_name, $email, $role){
    	$database = $this->database;
     	$emp = $database->getReference('employees')
     				 ->orderByChild('id')
     				 ->equalTo($id)
     				 ->getSnapshot()
     				 ->getValue();

        //if not found send false		 
     	if(empty($emp)){
     		return false;
     	}

     	$emp_key = key($emp);

  		$emp = new Employee($id, $first_name, $last_name, $email, $role);
		$updates = [
		    'employees/'.$emp_key => $emp,
		];

		$database->getReference()->update($updates);

		//not the most efficient check but its a check

		//get the same record again
		$emp_updated = $database->getReference('employees')
     				 ->orderByChild('id')
     				 ->equalTo($id)
     				 ->getSnapshot()
     				 ->getValue();

        //checks will count update success if it matches passed parameters
     	//checking passed parameters rather than $emp since record could still be "updated" with previous values 
     	//return 0 (false)
     	if($emp_updated[$emp_key]['first_name'] != $first_name){
     		return 0;
     	}
     	if($emp_updated[$emp_key]['last_name'] != $last_name){
     		return 0;
     	}
     	if($emp_updated[$emp_key]['email'] != $email){
     		return 0;
     	}
     	if($emp_updated[$emp_key]['role'] != $role){
     		return 0;
     	}
     	if($emp_updated[$emp_key]['id'] != $id){
     		return 0;
     	}

		return $emp_key;
    }

    public function deleteEmployee($id){
    	$database = $this->database;
     	$emp = $database->getReference('employees')
     				 ->orderByChild('id')
     				 ->equalTo($id)
     				 ->getSnapshot()
     				 ->getValue();

     	//if not found send false		 
     	if(empty($emp)){
     		return false;
     	}

     	$emp_key = key($emp);
     	$ref = 'employees/'.$emp_key;

  		$database->getReference($ref)->remove();

  		$exists = $database->getReference($ref)->getSnapshot()->exists();

  		//if doesn't exist then true
  		if(!$exists){
  			return 1;
  		}

		return 0;
    }
}