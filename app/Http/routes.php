<?php
Route::group(['middleware' => ['web']], function () {
    
    Route::get('/',function(){
    	return redirect(config('oblagio.backendUrl'));
    });
   	
  	include __DIR__.'/oblagioRoutes.php'; 
});
