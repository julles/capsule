<?php
Route::group(['middleware' => ['web']], function () {
    
    Route::get('/',function(){
    	return redirect(config('oblagio.backendUrl'));
    });
   	
  

		Route::get('auth','Backend\AuthController@login');
		Route::post('auth','Backend\AuthController@postLogin');
		Route::get('auth/sign-out','Backend\AuthController@signOut');
		Route::get('auth/forgot-password','Backend\AuthController@forgotPassword');
		Route::post('auth/forgot-password','Backend\AuthController@postForgotPassword');
		Route::group(['prefix' => og()->backendUrl , 'middleware' => ['backend','auth']],function(){
			
			if(og()->statusDevelopment != 'migration')
			{
				Route::get('/' , function(){
					return redirect(og()->firstMenu());
				});

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
					
			
			}
		});
   		
});
