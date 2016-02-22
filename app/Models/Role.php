<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    public $guarded = [];

    public function rules($id="")
    {
    	if(!empty($id))
    	{
    		$unique = ",name,".$id;
    	}else{
    		$unique = "";
    	}

    	return [
    		'name'	=>	'required|unique:roles'.$unique,
    	];
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
