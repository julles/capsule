<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public function login()
    {
		return view('oblagio.login');    	
    }

    public function postLogin(Request $request)
    {
    	$rules = [
    		'username'	=> 'required',
    		'password'	=> 'required',
    	];

    	$this->validate($request,$rules);

    	$credentials = [
    		'username'	=> $request->username,
    		'password'	=> $request->password,
    	];

    	if(\Auth::attempt($credentials))
    	{
    		return redirect(og()->backendUrl);
    	}else{
    		return redirect()->back()->withInfo('Username or Password wrong');
    	}

    }

    public function signOut()
    {
    	\Auth::logout();
    	return redirect('auth');
    }
}
