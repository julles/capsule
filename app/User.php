<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    public $guarded = ['verify_password'];

    public function user()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function rules($id="")
    {

    	if(!empty($id))
    	{
    		$uniqueUsername = ',username,'.$id;
    		$uniqueEmail = ',email,'.$id;
    	}else{
    		$uniqueUsername = "";
    		$uniqueEmail = "";
    	}

    	return [
    		'name'				=>	'required',
    		'username'			=>	'required|unique:users'.$uniqueUsername,
    		'email'				=>	'required|email|unique:users'.$uniqueEmail,
    		'role_id'			=>	'required',
    		'password'			=>	'required|min:5',
    		'verify_password' 	=>	'same:password',
    	];
    }
}
