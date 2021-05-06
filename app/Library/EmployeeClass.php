<?php

namespace App\Library;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;

class EmployeeClass implements EmployeeRepository
{
    public function listAll()
    {
        return Employee::all();
    }
}