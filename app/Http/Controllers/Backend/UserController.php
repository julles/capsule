<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;

use App\User;
use App\Models\Role;
use Table;
use Image;

class UserController extends CapsuleController
{
	public $model;

	public function __construct(User $model,Role $role)
	{
		parent::__construct();

		$this->model = $model;

		$this->roles = $role->lists('name','id');

		view()->share('roles' , $this->roles);
	}

	public function getData()
	{
		$model = $this->model->select('users.id','username','email','users.name','roles.name AS role_name')

			->join('roles','roles.id','=','users.id')

			->orderBy('users.created_at','desc');

		$tables = Table::of($model)
			->addColumn('action',function($model){
    			 return og()->links($model->id , ['update','delete']);
            })
			->make(true);

		return $tables;
	}

    public function getIndex()
    {
    	return view('oblagio.user.index');
    }

    public function getCreate()
    {
    	$model = $this->model;

    	return view('oblagio.user._form',compact('model'));
    }

    public function postCreate(Request $request)
    {
    	$this->validate($request,$this->model->rules());
    	$inputs = $request->all();

    	// upload avatar
    		$avatar = $request->file('avatar');
    		if(!empty($avatar))
    		{
    			$imageName = oblagioRandom(10).'.'.$avatar->getClientOriginalExtension();
				Image::make($avatar)->resize(160,160)->save(public_path('contents/'.$imageName));
    			$inputs['avatar'] = $imageName;
    		}
    	//

    	$inputs['password'] = \Hash::make($request->password);

    	$this->model->create($inputs);

    	return og()->flashSuccess('Data has been saved');
    }

    public function getUpdate($id)
    {
    	$model = $this->model->findOrFail($id);

    	return view('oblagio.user._form',compact('model'));
    }

    public function postUpdate(Request $request,$id)
    {
    	$model = $this->model->findOrFail($id);

    	$this->validate($request,$model->rules($id));

    	$inputs = $request->all();

    	// upload avatar
    		$avatar = $request->file('avatar');
    		if(!empty($avatar))
    		{
    			@unlink(contentsPath($model->avatar));

    			$imageName = oblagioRandom(10).'.'.$avatar->getClientOriginalExtension();
				Image::make($avatar)->resize(160,160)->save(public_path('contents/'.$imageName));
    			$inputs['avatar'] = $imageName;
    		}
    	//

    	$inputs['password'] = \Hash::make($request->password);

    	$model->update($inputs);

    	return og()->flashSuccess('Data has been updated');
    }

    public function getDelete($id)
    {
    	$model = $this->model->findOrFail($id);

    	try
    	{
    		@unlink(contentsPath($model->avatar));
    		$model->delete();
    		return og()->flashSuccess('Data has been Deleted');
    	}catch(\Exception $e){
    		return og()->flashInfo('Data Cannot Be Deleted');
    	}
    }

		public function getProfile()
		{
			$model = $this->model->find(user()->id);

			return view('oblagio.user._form',compact('model'));
		}

		public function postProfile(Request $request)
		{
			$model = $this->model->findOrFail(user()->id);

    	$this->validate($request,$model->rules(user()->id));

    	$inputs = $request->all();

    	// upload avatar
    		$avatar = $request->file('avatar');
    		if(!empty($avatar))
    		{
    			@unlink(contentsPath($model->avatar));

    			$imageName = oblagioRandom(10).'.'.$avatar->getClientOriginalExtension();
				Image::make($avatar)->resize(160,160)->save(public_path('contents/'.$imageName));
    			$inputs['avatar'] = $imageName;
    		}
    	//

    	$inputs['password'] = \Hash::make($request->password);

    	$model->update($inputs);

    	return redirect()->back()->withSweetsuccess('Data has been updated');
		}
}
