<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Employee 
{
    //use HasFactory;
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $role;

    function __construct($id, $first_name, $last_name, $email, $role) {
    	$this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->role = $role;
    }

}
