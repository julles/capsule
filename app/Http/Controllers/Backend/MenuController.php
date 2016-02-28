<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;
use App\Models\Menu;
use App\Models\Action;
use App\Models\MenuAction;
use DB;
use Table;
use Image;
class MenuController extends CapsuleController
{
	public $model;
	public function __construct(Menu $model,Action $action,MenuAction $menuAction)
	{
		parent::__construct();
		$this->model = $model;
        $this->action = $action;
        $this->menuAction = $menuAction;
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
			if($model->id == 1 || $this->model->childs($id)->count() > 0)
            {
                return og()->flashInfo('Data cannot be deleted');     
            }
            
            $model->delete();
			
            return og()->flashSuccess('Data has been deleted');		
	
		}catch(\Exception $e){
		  return og()->flashInfo('Data cannot be deleted');     
		}
	}

    public function getView($id)
    {
        $model = $this->model->findOrFail($id);
       
        $actions = $this->action->all();

        $checked = function($id) use ($model)
        {
            $action =  $model->actions->find($id);
            if(!empty($action->id))
            {
                return $action->id; 
            }
        }; // closure search action in menu

        return view('oblagio.menu.view',compact('model','actions','checked'));
    }

    public function postView(Request $request , $id)
    {
        $model = $this->model->findOrFail($id);
        
        DB::beginTransaction();

        try{

            $this->menuAction->whereMenuId($model->id)->delete();

            $count = count($request->action_id);
            
            for($i=0;$i<$count;$i++)
            {
                $this->menuAction->create([
                    'menu_id'   => $model->id,
                    'action_id' => $request->action_id[$i],
                ]);
            }

            DB::commit();

            return og()->flashSuccess('Action has been saved');

        }catch(\Exception $e){

            DB::rollback();

            return og()->flashInfo('Transaction Failed : '.$e->getMessage());
        }
    }
}
