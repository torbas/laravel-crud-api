<?php

namespace App\Repositories;

//use interface to make it easy to swap out logic if storage method changes
Interface EmployeeRepository
{
    public function listAll();
    public function createEmployee($first_name, $last_name, $email, $role);
    public function showEmployee($id);
    public function updateEmployee($id, $first_name, $last_name, $email, $role);
    public function deleteEmployee($id);
}