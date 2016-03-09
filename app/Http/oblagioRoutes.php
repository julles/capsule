<?php

Route::group(['prefix' => og()->backendUrl , 'middleware' => ['web','auth','backend']],function(){
		if(\Schema::hasTable('menus'))
		{
			foreach(og()->menu()->where('controller','!=','#')->get() as $row)
			{
				Route::controller($row->permalink,$row->controller);
				
			}
		}
		
});
