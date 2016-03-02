<?php
/**
 * Author : Muhamad Reza Abdul Rohim <reza.wikrama3@gmail.com>
 *
 * CV Oblagio Berdaya
 *
 * Helper Core Oblagio Class
 *
 */
namespace App\Oblagio\Acme\Src;
use App\Models\Menu;
use App\Models\Action;
use App\User;

class Oblagio
{
	public $appName;

	public $assetUrl;

	public $assetLte;

	public $backendUrl;

	public $contentsPath;

	public function __construct()
	{
		$this->appName = config('oblagio.appName');

		$this->backendUrl = config('oblagio.backendUrl');

		$this->assetUrl = asset(null);

		$this->assetLte = $this->assetUrl.'adminlte/';

		$this->statusDevelopment = config('oblagio.status');

		$this->contentsPath = public_path('contents/');
	}

	public function onlyUrlNotAction()
	{
		return $this->urlBackend(\Request::segment(2));
	}

	public function urlBackend($url)
	{
		return url($this->backendUrl.'/'.$url);
	}

	public function urlBackendAction($url)
	{
		return $this->onlyUrlNotAction().'/'.$url;
	}

	public function menu()
	{
		return new Menu;
	}

	public function action()
	{
		return new Action;
	}

	public function getMenuAttribute($permalink = "")
	{
		if(!empty($permalink))
		{
			$segmentMenu = $permalink;
		}else{
			$segmentMenu = request()->segment(2);
		}

		$model = $this->menu()->wherePermalink($segmentMenu)->first();

		return $model;

	}

	public function getMenuAttributeFind($id)
	{
		$model = $this->menu()->find($id);

		return $model;

	}

	public function firstMenu($permalink = "")
	{
		return $this->urlBackend(config('oblagio.firstMenu'));
	}

	public function getActionAttribute($permalink = "")
	{
		if(!empty($permalink))
		{
			$segmentAction = $permalink;
		}else{
			$segmentAction = !empty(request()->segment(3)) ? request()->segment(3) : '';
		}

		$model = $this->action()->whereCode($segmentAction)->first();

		return $model;
	}

	public function cekRight($action = "",$menu = "")
	{
		$actionUrl = !empty($action) ? $action : request()->segment(3);

		$modelAction = $this->getActionAttribute($actionUrl);

		if(!empty($modelAction))
		{
			$actionId = $modelAction->id;

			$menu = $this->getMenuAttribute();

			$get = user()->role->rights()
				->whereMenuId($menu->id)
				->whereActionId($actionId)
				->first();

			if(!empty($get->id))
			{
				return 'true';
			}else{
				return 'false';
			}
		}else{
			return 'true';
		}

	}

	public function checkIfArray3Dimension($array = [])
	{
		$count = count($array);

		for($a=0;$a<$count;$a++)
		{
			if(is_array(@$array[$a]))
			{
				return true;
			}else{
				throw new \Exception("Format Eloquent Salah , Konversi array 3 dimensi ke 2 dimensi gagal ! , helper oblagio table tidak bisa dijalankan");
			}
		}
	}

	public function convertArrayTo2Dimension($array = [])
	{
		$check = $this->checkIfArray3Dimension($array);

		if($check == true)
		{
			$result2Dimension = [];
			foreach($array as $threeDimension)
			{
				$twoDimension = [];
				foreach($threeDimension as $key => $value)
				{
					$twoDimension[$key] = $value;
				}

				$result2Dimension = $twoDimension;
			}

			return $result2Dimension;
		}
	}

	public function getFieldEloquent($eloquent = "")

	{
		$twoDimension = $this->convertArrayTo2Dimension($eloquent);
		$field = [];
		foreach($twoDimension as $key => $value)
		{
			$field[] = $key;
		}

		return $field;
	}

	public function link($label , $others = [])
	{
		if($others != [])
		{
			$str = "";
			foreach($others as $key => $value)
			{
				$str .= $key."='$value'";
			}

			$others = $str;

		}else{

			$others = '';

		}

		return "<a ".$others.">".$label."</a>";
	}

	public function linkCreate()
	{
		$properties = [
			'class'		=> 'btn btn-primary btn-sm',
			'href'		=> $this->urlBackendAction('create'),
		];

		if($this->cekRight('create') == 'true')
			return $this->link('Add New &nbsp; <i class="fa fa-plus"></i>',$properties);
	}

	public function linkUpdate($urlPlus = "")
	{
		$properties = [
			'class'		=> 'btn btn-success btn-sm',
			'href'		=> $this->urlBackendAction('update/'.$urlPlus),
		];

		if($this->cekRight('update') == 'true')

			return $this->link('<i class="fa fa-pencil"></i>',$properties);
	}

	public function linkView($urlPlus = "")
	{
		$properties = [
			'class'		=> 'btn btn-info btn-sm',
			'href'		=> $this->urlBackendAction('view/'.$urlPlus),
		];

		if($this->cekRight('view') == 'true')
			return $this->link('<i class="fa fa-eye"></i>',$properties);
	}

	public function linkDelete($urlPlus = "")
	{
		$properties = [
			'class'		=> 'btn btn-danger btn-sm',
			'href'		=> $this->urlBackendAction('delete/'.$urlPlus),
			'onclick'	=> 'return confirm("are you sure want to delete this item ?")'
		];

		if($this->cekRight('delete') == 'true')
			return $this->link('<i class="fa fa-trash"></i>',$properties);
	}

	public function links($id , $links = [] , $makeLink = [])
	{
		$linkUpdate = $this->linkUpdate($id);

		$linkView = $this->linkView($id);

		$linkDelete = $this->linkDelete($id);

		$buttons = [
			'update'	=> $linkUpdate,
			'view'		=> $linkView,
			'delete'	=> $linkDelete,
		];

		$links = (!empty($links)) ? $links : array_keys($buttons);

		$strButton = "";

		foreach($links as $row)
		{
			$strButton .= $buttons[$row].' ';
		}

		if($makeLink != [])
		{
			foreach($makeLink as $make)
			{
				$strButton .= $make;
			}
		}

		return $strButton;
	}

	public function oblagioRandom()
	{
		return str_random(10).date("YmdHis");
	}

	public function flash($keyMessage , $valueMessage , $action = "")
	{
		$action = (!empty($action)) ? $action : og()->urlBackendAction('index');

		return redirect($action)
			->with($keyMessage,$valueMessage);
	}

	public function flashSuccess($message = "",$action="")
	{
		return $this->flash('success',$message,$action);
	}

	public function flashInfo($message = "",$action="")
	{
		return $this->flash('info',$message,$action);
	}

	public function user()
	{
		$user = \Auth::user();
		return $user;
	}

	public function carbon()
	{
		return new \Carbon\Carbon;
	}

}
