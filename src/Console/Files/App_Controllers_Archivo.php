<?php
namespace App\Controllers;
use Marve\Ela\Controllers\ModelController;
//#TODO Verifica la clase
use App\Core\Archivos;
use Marve\Ela\Core\CurrentUser;

class Archivo extends ModelController
{
    /**
     */
    public function __construct() 
    {                
      $this->class = new Archivos(CurrentUser::getDb());
      parent::__construct("ArcID");        
    }           
}
