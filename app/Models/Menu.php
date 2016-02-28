<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\MenuAction;

class Menu extends Model
{
    public $guarded = [];

    

    public function actions()
    {
        return $this->belongsToMany(Action::class,'menu_actions')
            ->withPivot(['id']);
    }

    public function childs($id)
    {
    	return $this->whereParentId($id)->orderBy('order','asc')->get();
    }

    public function countChild($id)
    {
    	$model = $this->whereParentId($id)->count();

    	return $model;
    }

    public function rules($id="",$request)
    {

    	if($request->controller == '#')
    	{
    		$uController = "";
    	}else{
    		
    		$uController = 'unique:menus';

    		if(!empty($id))
    		{
    			$uController .= ",controller,".$id;
    		}
    	}

    	if(!empty($id))
    	{
    		$uTitle = ",title,".$id;
    	}else{
    		$uTitle = "";
    	}


    	return [
    		'title'			=> 'required|unique:menus'.$uTitle,
    		'controller'	=> 'required|'.$uController,
    	];
    }

    public function setPermalink($request)
    {
    	if($request->controller == '#')
    	{
    		return '#';
    	}else{
    		return str_slug($request->permalink);
    	}
    }
}
