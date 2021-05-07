<?php

namespace App\Repositories;

Interface EmployeeRepository
{
    public function listAll();
    public function createEmployee($first_name, $last_name, $email, $role);
    public function showEmployee($id);
    public function updateEmployee($id, $first_name, $last_name, $email, $role);
    public function deleteEmployee($id);
}