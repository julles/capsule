<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuAction;

class Right extends Model
{
	public $guarded = [];

	public function menu_actions()
	{
		return $this->belongsToMany(MenuAction::class,'rights')
			->withPivot(['id','action_id']);
	}
}
