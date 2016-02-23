<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OgCapsule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capsule:generate {pathModel} {pathController} {pathView}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crud Generator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public $pathModel;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    
    public function cekModel($model)
    {   
        $realPathModel = app_path("Models/".$model.'.php');
        if(file_exists($realPathModel))
        {
            $strModel = "App\\Models\\".$model;
            $model = new $strModel;
            return $model->getTable();
        }else{
            $this->info('Model Not Found!');
            exit;
        }   
    }

    public function getColumnListing($tableName)
    {
        $lists = \DB::getSchemaBuilder()->getColumnListing($tableName);

        return $lists;
    }

    public function getColumnSelect($model)
    {
        $modelFix = $this->cekModel($model);
        $columns = $this->getColumnListing($modelFix);
        $str = "";
        foreach($columns as $row)
        {
            $str.="'$row',";
        }
        return substr($str,0,-1);
    }

    public function replaceController($str,$model,$controller,$view)
    {
        $search = [
                    "App\\Models\\Template",
                    '__construct(Template $model)',
                    'TemplateController',
                    'template_view.index',
                    'template_view._form',
                    'select()',
                ];
        $replace = [
                        "App\\Models\\$model",
                        '__construct('.$model.' $model)',
                        $controller,
                        $view.'.index',
                        $view.'._form',
                        'select('.$this->getColumnSelect($model).')',
                    ];

        $replaceController = str_replace($search,$replace,$str);
        return $replaceController;
    }

    public function createController($model,$controller,$view)
    {
        $controllerTemplate = app_path('Oblagio/Acme/Src/Generators/ControllerTemplate.php');
        $getControllerContent = file_get_contents($controllerTemplate);
        $replaceController = $this->replaceController($getControllerContent,$model,$controller,$view);
        $createFile = fopen(app_path('Http/Controllers/Backend/'.$controller.'.php'), "w");
        fwrite($createFile, $replaceController);
        fclose($createFile);
        return 'Sukses';
    }

    public function createView($view)
    {
        $viewTemplate = base_path($view);
        return $viewTemplate;
    }

    public function handle()
    {
        $pathModel = $this->argument('pathModel');
        $pathController = $this->argument('pathController');
        $pathView = $this->argument('pathView');
        
        $tableName = $this->cekModel($pathModel);

        $this->createController($pathModel,$pathController,$pathView);    
        //$this->info($this->createView($pathView));
    }
}
