<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;
use App\Models\Role;

use Table;
use Image;
class RoleController extends CapsuleController
{
	public $model;
	public function __construct(Role $model)
	{
		parent::__construct();
		$this->model = $model;
	}

    public function getIndex()
    {
    	return view('oblagio.role.index');
    }

    public function getData()
    {
    	$data = $this->model->select('id','name');
    	
    	$tables = Table::of($data)
    		->addColumn('action',function($model){
    			return og()->links($model->id);
    		})
    		->make(true);
    	
    	return $tables;
    }

    public function getCreate()
    {
    	return view('oblagio.role._form',[
			'model' => $this->model,
		]);
    }

    public function postCreate(Request $request)
    {
    	$this->validate($request,$this->model->rules());
    	$this->model->create($request->all());
 		return og()->flashSuccess('Data has been saved');
 	}

	public function getUpdate($id)
    {
    	$model = $this->model->findOrFail($id);
    	return view('oblagio.role._form',[
			'model' => $model,
		]);
    }

    public function postUpdate(Request $request,$id)
    {
    	$this->validate($request,$this->model->rules($id));
    	$model = $this->model->findOrFail($id);
    	$model->update($request->all());
   		return og()->flashSuccess('Data has been updated');	
	}

	public function getDelete($id)
	{
		$model = $this->model->findOrFail($id);

		try
		{
			$model->delete();
			return og()->flashSuccess('Data has been deleted');		
	
		}catch(\Exception $e){
		  return og()->flashInfo('Data cannot be deleted');     
		}
	}
}
