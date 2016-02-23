<?php

Route::get('auth','Backend\AuthController@login');
Route::post('auth','Backend\AuthController@postLogin');
Route::get('auth/sign-out','Backend\AuthController@signOut');
Route::group(['prefix' => og()->backendUrl , 'middleware' => ['backend','auth']],function(){
	
	if(og()->statusDevelopment != 'migration')
	{
		Route::get('/' , function(){
			return redirect(og()->firstMenu());
		});

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