<?php

Route::get('/',function(){
    	return redirect(config('oblagio.backendUrl').'/'.config('oblagio.firstMenu').'/index');
});

Route::group(['middleware' => ['web']], function () {

	Route::get('auth','Backend\AuthController@login');
	Route::post('auth','Backend\AuthController@postLogin');
	Route::get('auth/sign-out','Backend\AuthController@signOut');
	Route::get('auth/forgot-password','Backend\AuthController@forgotPassword');
	Route::post('auth/forgot-password','Backend\AuthController@postForgotPassword');	

});

include __DIR__.'/oblagioRoutes.php';
