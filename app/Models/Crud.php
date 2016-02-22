<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    public $guarded = [];

    public function rules()
    {
    	return [
    		'name' => 'required',
    	];
    }
}
