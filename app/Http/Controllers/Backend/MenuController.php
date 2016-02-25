<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;
use App\Models\Menu;

use Table;
use Image;
class MenuController extends CapsuleController
{
	public $model;
	public function __construct(Menu $model)
	{
		parent::__construct();
		$this->model = $model;
        $parentLists = ['0' => 'This Parent'] + $this->model->whereParentId(0)->lists('title','id')->toArray();
	    view()->share('parentLists',$parentLists);
    }

    public function getIndex()
    {
        $model = $this->model;
        $parents = $model->whereParentId(0)->orderBy('order','asc')->get();
    	return view('oblagio.menu.index',[
            'model'     => $model,
            'parents'   => $parents,
        ]);
    }

    public function getCreate()
    {
    	return view('oblagio.menu._form',[
			'model' => $this->model,
		]);
    }

    public function postCreate(Request $request)
    {
    	$this->validate($request,$this->model->rules("",$request));
        $inputs = $request->all();
        $inputs['permalink'] = $this->model->setPermalink($request);
    	$this->model->create($request->all());
 		return og()->flashSuccess('Data has been saved');
 	}

	public function getUpdate($id)
    {
    	$model = $this->model->findOrFail($id);
    	return view('oblagio.menu._form',[
			'model' => $model,
		]);
    }

    public function postUpdate(Request $request,$id)
    {
        $model = $this->model->findOrFail($id);
    	$this->validate($request,$model->rules($id,$request));
        $inputs = $request->all();
        $inputs['permalink'] = $this->model->setPermalink($request);
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