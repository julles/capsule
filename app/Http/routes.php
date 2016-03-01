<?php


Route::group(['middleware' => ['web']], function () {
	

    Route::get('/',function(){
    	return redirect(config('oblagio.backendUrl').'/'.config('oblagio.firstMenu').'/index');
    });
   	
  	include __DIR__.'/oblagioRoutes.php'; 
});
