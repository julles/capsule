<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

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
    		return redirect(og()->firstMenu().'/index');
    	}else{
    		return redirect()->back()->withInfo('Username or Password wrong');
    	}

    }

    public function signOut()
    {
    	\Auth::logout();
    	return redirect('auth');
    }

    public function forgotPassword()
    {
        return view('oblagio.forgot');
    }

    public function postForgotPassword(Request $request)
    {
        $this->validate($request,['email'=>'required|email']);

        $cek = User::whereEmail($request->email)->first();
        
        if(empty($cek->id))
        {
            return redirect()->back()->withInfo('Your email not found');
        }

        $newPassword = 'capsule'.str_random(5);

        $cek->update([
            'password' => \Hash::make($newPassword),
        ]);

        \Mail::send('oblagio.emails.forgot_password',['model'=>$cek,'newPassword'=> $newPassword] , function($m) use ($cek){
            $m->from('no-reply@capsule.com');
            $m->to($cek->email)->subject('Forgot Password '.$cek->name);
        });

        return redirect()->back()->withInfo('please check your email, the system has sent a new password');
    
    }
}
