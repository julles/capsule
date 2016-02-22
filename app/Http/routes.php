<?php
Route::group(['middleware' => ['web']], function () {
    
    Route::get('/',function(){
    	return view('welcome');
    });
   	
   include __DIR__.'/oblagioRoutes.php';
   		
});
