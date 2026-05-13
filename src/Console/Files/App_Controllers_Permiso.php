<?php
namespace App\Controllers;
use App\Core\Archivos;
use Marve\Ela\Controllers\ModelController;
//#TODO Verifica la clase
use App\Core\Permisos;
use App\Core\Policies;
use Marve\Ela\Core\CurrentUser;
use stdClass;

class Permiso extends ModelController
{
    /**
     */
    public function __construct() 
    {                
      $this->class = new Permisos(CurrentUser::getDb());
      parent::__construct("PusUsuario");        
    }           

     protected function store($data)
	  {		        
        $ARCHIVO = new Archivos(CurrentUser::getDb());
        $POLICY = new Policies(CurrentUser::getDb());
        $permisos = explode(",",$data->PusPermisos);
        $policies = explode(",",$data->PusPolicies);
        for ($i = 0; $i < count($permisos); $i++) 
        {
            $policy = new stdClass();
            $policy->PolUsuario = $data->PusUsuario;
            $policy->PolFile = $ARCHIVO->get($permisos[$i], "ArcID")->ArcPath;
            $policy->PolPolicy = $policies[$i];
            $POLICY->storeUnique($policy);
        }
        $data->PusPermisos = implode(',',array_unique(explode(",",$data->PusPermisos)));          
        return parent::store($data);
	  }

}
