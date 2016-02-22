<?php namespace App\Oblagio\Acme\Src;

class OblagioProvider extends \Illuminate\Support\ServiceProvider
{
	public function boot()
	{
		// gunakan boot jika di perlukan
	}

	public function register()
	{
		$this->mergeConfigFrom(config_path().'/oblagio.php','oblagio');

		$this->app->bind('register-oblagio' , function(){
			return new \App\Oblagio\Acme\Src\Oblagio;
		});
	}
}