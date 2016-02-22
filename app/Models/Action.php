<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $guarded = [];

    public function rules($id="")
    {
    	if(!empty($id))
    	{
    		$unique = ",code,".$id;
    	}else{
    		$unique = "";
    	}

    	return [
    		'code'		=>	'unique:actions'.$unique,
    		'label'		=> 'required',
    	];
    }
}
