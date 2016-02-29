<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;
use App\Models\Role;
use App\Models\Menu;
use App\Models\MenuAction;
use App\Models\Right;
use Table;
use Image;
use DB;

class RoleController extends CapsuleController
{
	public $model;
	public function __construct(Role $model,Menu $menu,MenuAction $menuAction,Right $right)
	{
		parent::__construct();
		$this->model = $model;
        $this->menuAction = $menuAction;
        $this->menu = $menu;
        $this->right = $right;
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

    public function getView($id)
    {
        $model = $this->model->findOrFail($id);
        
        $parentMenus = $this->menu->whereParentId(0)->orderBy('order','desc')->get();
        
        $menu = $this->menu;

        $rightFirst = function($id) use ($model)
        {
            $right = $model->rights()->whereMenuActionId($id)->first();
            return (!empty($right->id)) ? $right->id : '';
        };

        return view('oblagio.role.view',compact('model','parentMenus','menu','rightFirst'));
    }

    public function postView(Request $request , $id)
    {
        $model = $this->model->findOrFail($id);

        DB::beginTransaction();

        try
        {
            $count = count($request->menu_action_id);
            DB::table('rights')->where('role_id',$model->id)->delete();

            for($a=0;$a<$count;$a++)
            {
                if(!empty($request->menu_action_id[$a]))
                {
                    $this->right->create([
                        'role_id'           => $model->id,
                        'menu_action_id'    => $request->menu_action_id[$a]
                    ]);
                }
            }

            DB::commit();

            return og()->flashSuccess('actions has been updated');

        }catch(\Exception $e){
            DB::rollback();
            return og()->flashInfo('Transaction failed! : '.$e->getMessage());
        }
    }
}
