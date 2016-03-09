<?php

Route::group(['prefix' => og()->backendUrl , 'middleware' => ['web','auth','backend']],function(){
		if(\Schema::hasTable('menus'))
		{
			foreach(og()->menu()->where('controller','!=','#')->get() as $row)
			{
				$controllerPath = app_path('Http/Controllers/'.$row->controller.'.php');

				if(file_exists($controllerPath))
				{
					Route::controller($row->permalink,$row->controller);
				}
			}
		}
		
});
