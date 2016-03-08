<?php

Route::group(['prefix' => og()->backendUrl , 'middleware' => ['auth','backend']],function(){
		
		Route::get('/' , function(){
			return redirect('auth');
		});
		Route::auth();
		if(\Schema::hasTable('menus'))
		{
			foreach(og()->menu()->where('permalink','!=','#')->get() as $row)
			{
				$controllerPath = app_path('Http/Controllers/'.$row->controller.'.php');

				if(file_exists($controllerPath))
				{
					Route::controller($row->permalink,$row->controller);
				}
			}
		}
});
