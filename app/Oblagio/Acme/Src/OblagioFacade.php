<?php namespace App\Oblagio\Acme\Src;

class OblagioFacade extends \Illuminate\Support\Facades\Facade
{
	public static function getFacadeAccessor()
	{
		return 'register-oblagio';
	}
}