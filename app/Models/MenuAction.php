<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Action;
use App\Models\Role;

class MenuAction extends Model
{
	protected $table = 'menu_actions';

    public $guarded = [];

	public function menu()
	{
		return $this->belongsTo(Menu::class ,'menu_id');
	}

	public function action()
	{
		return $this->belongsTo(Action::class ,'action_id');
	}

	public function rights()
	{
		return $this->belongsToMany(Role::class,'rigths');
	}    
}
