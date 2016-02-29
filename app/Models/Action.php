<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Action extends Model
{
    public $guarded = [];

    public function menus()
    {
        return $this->belongsToMany(Menu::class,'menu_actions')
            ->withPivot(['id']);
    }

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
