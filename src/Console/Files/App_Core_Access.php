<?php
namespace App\Core;
use App\Enum\Permiso;
use App\Models\Data\PoliciesD;
use Marve\Ela\Core\CurrentUser;
use Marve\Ela\Core\DotEnv;
use Marve\Ela\Core\Generic;
use Marve\Ela\Core\Model;
use Marve\Ela\Interfaces\MiddlewareHandleInterface;



class Access extends Model implements MiddlewareHandleInterface
{
   
      
    /**
     *
     * @var array
     */
    public $mensaje;
    /**
     *
     * @var AccessD
     */
    public $data;

    public function __construct( $data_base = "")
    {
        if($data_base == "")
            $data_base = DotEnv::getDB();
        $this->data_base = $data_base;
        $this->mensaje = array();        
        parent::__construct($data_base, "permisos");
                
    }

    public function remove(string $id, string $campo="PusID",  int $usuario = 0)
    {
        if(CurrentUser::isAdmin())
           return  parent::remove($id,$campo,$usuario);
        else return 0;
    }
  
  
    
    public function permission($pagina)
    {        
        $pages = [];
        $access = $this->get(CurrentUser::getId(),"PusUsuario");
        if($access !== 0)
        $pages = explode(",", $access->PusPermisos);
        $PAGINA = new Generic($this->data_base, "archivos");
        $pagid = $PAGINA->get($pagina,"ArcPath");
        if($pagid !== 0)
            return in_array($pagid->ArcID, $pages);
        else return false;
    }
    
    public function addEdit(int $usuario, string $archivo, Permiso $permiso)
    {        
        $PERMISOS = new Policies(CurrentUser::getDb());
        $permisos = $PERMISOS->get("0","","PolUsuario = $usuario AND PolFile = '$archivo'")[0]?? new PoliciesD();          
        return $permiso->value <= $permisos->PolPolicy;  
        return match ($permiso) 
        {
            Permiso::Eliminar => $permisos->PolPolicy == 1,
            Permiso::Editar => $permisos->PolPolicy == 2,
            Permiso::Agregar => $permisos->PolPolicy == 3,
            Permiso::Ver => $permisos->PolPolicy == 4,                                                    
             default => false             
        };            
    }
    /**
     * Summary of render
     * @param int $usuario
     * @return string
     */
    public function render($usuario = 0)
    {
        $modulo = "0";
        $html = "<div class='row row gx-5 justify-content-center'>";
        $secciones = $this->query("*", "modulos", ($usuario == 1)?"0":"ModRol > 1");
        $count = 0;
        foreach ($secciones as $seccion)
        {
            if($count++ > 2)
            {
                $count = 0;                
            }
            else $end = "";
            $pages = $this->query("*", "archivos","ArcModulo = ".$seccion->ModID,  "ArcOrden");
            if(count($pages) > 0)
            {
                $html .= "<div class='col-md-4'>";
                $html .= "  <h5> ".$seccion->ModNombre."  </h5>";
                $html .= "  <ul class='list-group' style='margin-left:0.5rem;'>";                                
                foreach ($pages as $page)
                {
                    $html .= "      <li class='list-group-item'>
                                        <div class='form-check'>                                            
                                        <input class='form-check-input permisos' type='checkbox' id='id_".$page->ArcID."' value='".$page->ArcID."' />
                                        <label  class='form-check-label' for='id_".$page->ArcID."' >".$page->ArcNombre."</label>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='ArcPermisos_".$page->ArcID."' id='per_View_".$page->ArcID."' value='View'>
                                                <label class='form-check-label' for='per_View_".$page->ArcID."'>Ver</label>
                                            </div>
                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='ArcPermisos_".$page->ArcID."' id='per_Add_".$page->ArcID."' value='Add'>
                                                <label class='form-check-label' for='per_Add_".$page->ArcID."'>Agregar</label>
                                            </div>

                                            <div class='form-check'>
                                                <input class='form-check-input' type='radio' name='ArcPermisos_".$page->ArcID."' id='per_Edit_".$page->ArcID."' value='Edit'>
                                                <label class='form-check-label' for='per_Edit_".$page->ArcID."'>Editar</label>
                                            </div>

                                            <div class='form-check mb-4'>
                                                <input class='form-check-input' type='radio' name='ArcPermisos_".$page->ArcID."' id='per_Delete_".$page->ArcID."' value='Delete'>
                                                <label class='form-check-label' for='per_Delete_".$page->ArcID."'>Eliminar</label>
                                            </div>      
                                        </div>
                                </li>";
                    
                }
                
                $html .= "        </ul>";
                $html .= "      </li>";
                $html .= "    </ul>";
                $html .= "</div>";
            }
        }       
        $html .= "</div>";
        $html .= "<div class='col-md-4'>
                    <ul class='list-group' style='margin-left:0.5rem;'>
                        <li class='list-group-item'>
                            <div class='form-check'>                                            
                                <input class='form-check-input permisosEspecial' type='checkbox' id='PerAdd' value='PerAdd' />
                                <label  class='form-check-label' for='Add' >Agregar nuevos</label>
                            </div> 
                        </li>
                        <li class='list-group-item'>
                            <div class='form-check'>                                            
                                <input class='form-check-input permisosEspecial' type='checkbox' id='PerEdit' value='PerEdit' />
                                <label  class='form-check-label' for='Edit' >Editar existentes</label>                                            
                            </div>
                        </li>
                    </ul>
                </div>";                
        return $html;
    }
        
    public function handle(array $auth)
    {       
        $aproved = $this->permission($auth["page"]); 
        if(isset($auth["permisos"]))            
            return $this->addEdit(CurrentUser::getId(),$auth["page"],Permiso::tryFrom($auth["permisos"]));
        return $aproved;       
    }        

    public function getAccess($user)
    {
         $access = $this->get(CurrentUser::getId(),"PusUsuario");
        if($access !== 0)
        {
            $pages = explode(",", $access->PusPermisos);
            $PAGINA = new Generic($this->data_base, "archivos");
            return  $PAGINA->get($pages[0],"ArcID")->ArcPath;
        }
        else return 0;
    }
}
