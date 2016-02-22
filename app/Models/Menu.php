<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $guarded = [];

    public function countChild($id)
    {
    	$model = $this->whereParentId($id)->count();

    	return $model;
    }
}
