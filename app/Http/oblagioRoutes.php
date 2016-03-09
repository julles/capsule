<?php

Route::group(['prefix' => og()->backendUrl , 'middleware' => ['web','auth','backend']],function(){
		if(\Schema::hasTable('menus'))
		{
			foreach(og()->menu()->where('controller','!=','#')->get() as $row)
			{
				if(\File::exists(app_path('Http/Controllers/'.str_replace("\\","/",$row->controller.'.php'))))
				{
					Route::controller($row->permalink,$row->controller);
				}
				
			}
		}
		
});
