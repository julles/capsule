<?php
/**
 * Author : Muhamad Reza Abdul Rohim <reza.wikrama3@gmail.com>
 * 
 * CV Oblagio Berdaya
 * 
 * Example Crud Controller in Capsule admin panel Laravel 5
 * 
 */
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\CapsuleController;
use App\Models\Crud;

use Table;
use Image;

class CrudController extends CapsuleController
{
	public $model;

	/**
	 *  Declare global variables
	 *  
	 *  parent::__construct(); get all variabel in constructor CapsuleController
	 */

	public function __construct(Crud $model)
	{
		parent::__construct();

		$this->model = $model;

		$this->gender = ['men'=>'Men','woman'=>'Woman'];

		view()->share('gender' , $this->gender);
	}

	/**
	 * Returning All data from database using eloquent and Datatables Serverside
	 * 
	 * using Yajra/Datatables package
	 * 
	 */

	public function getData()
	{
		$model = Crud::select('id','name','company','gender');

		$tables = Table::of($model)
			->addColumn('gender',function($model){
				return ucfirst($model->gender);
			})
			->addColumn('action',function($model){
					return og()->links($model->id , ['update','delete']);
    		})
			->make(true);

		return $tables;
	}

	/**
	 * returning action index in GET method
	 * 
	 * See view() helper in laravel 5.2 docs
	 */

	public function getIndex()
	{
		return view('oblagio.crud.index');
	}

	/**
	 * returning action create in GET method
	 * 
	 * See view() helper in laravel 5.2 docs
	 */
	
	public function getCreate()
	{
		return view('oblagio.crud._form',[
			'model' => $this->model,
		]);
	}

	/**
	 * returning action create in POST method
	 * 
	 *  explain :
	 *  
	 *  Validating Form Request , Upload photo and thumbnail photo and insert to table
	 */

	public function postCreate(Request $request)
	{
		$this->validate($request,$this->model->rules());
		$inputs = $request->all();
		$photo = $request->file('photo');
		if(!empty($photo))
		{
			$imageName = oblagioRandom(10).'.'.$photo->getClientOriginalExtension();
			$photo->move('contents',$imageName);

			// create thumbnail
			Image::make(public_path('contents/'.$imageName))
				->resize(100,100)
				->save(public_path('contents/thumbnails/'.$imageName));
			// 

			$inputs['photo'] = $imageName;
		}

		$this->model->create($inputs);

		return og()->flashSuccess('Data has been saved');
	}

	/**
	 * returning action update in GET method
	 * 
	 * See view() helper in laravel 5.2 docs
	 */

	public function getUpdate($id)
	{
		$model = $this->model->findOrFail($id);
		return view('oblagio.crud._form',[
			'model' => $model,
		]);
	}

	/**
	 * returning action update in POST method
	 * 
	 *  explain :
	 *  
	 *  Validating Form Request , Upload photo and thumbnail photo and update to table
	 */

	public function postUpdate(Request $request,$id)
	{
		$model = $this->model->find($id);
		$this->validate($request,$this->model->rules());
		$inputs = $request->all();
		$photo = $request->file('photo');
		if(!empty($photo))
		{
			@unlink(contentsPath($model->photo));
			$imageName = oblagioRandom(10).'.'.$photo->getClientOriginalExtension();
			$photo->move('contents',$imageName);
			
			// create thumbnail
			@unlink(contentsPath('thumbnails/'.$model->photo));
			Image::make(public_path('contents/'.$imageName))
				->resize(100,100)
				->save(public_path('contents/thumbnails/'.$imageName));
			// 
			
			$inputs['photo'] = $imageName;
		}

		$model->update($inputs);

		return og()->flashSuccess('Data has been updated');
	}

	/**
	 * returning action delete in get method
	 * 
	 *  explain :
	 *  
	 *  Deleting photo , thumbnail and record table
	 */

	public function getDelete($id)
	{
		$model = $this->model->findOrFail($id);
		$path = contentsPath();
		
		@unlink($path.$model->photo);
		@unlink($path.'thumbnails/'.$model->photo);
		
		$model->delete();
		
		return og()->flashSuccess('Data has been deleted');
	}
}
