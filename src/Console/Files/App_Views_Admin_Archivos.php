<?php

/**
 *
 * @version v2022_1
 *         
 * @author Martin Mata
 *        
 */

use App\Enum\Permiso;
use App\Grids\Archivos;
use Marve\Ela\Core\CurrentUser;
use Marve\Ela\Grid\Datagrid;

global $params;


$GRID = new Datagrid();
$GRID->inicio(CurrentUser::getDb());      

$editar = CurrentUser::isAdmin();
$roles = $GRID->g->get_dropdown_values("select distinct RolID as k, RolNombre as v from rol where RolID > ".CurrentUser::getRol());

$opt["detail_grid_id"] = "list2";
$GRID->g->set_options($opt);

$GRID->campos(Archivos::modulos(array("editar"=>$editar,"rol"=>$roles)));
$GRID->encabezado("Modulos", "ModID", array(false, true, false, true, false), "asc", "400","200");
$GRID->sql("Select * from modulos", "modulos");
$master = $GRID->mostrar();

/***************************************************/

$GRID = new Datagrid();
$GRID->inicio(CurrentUser::getDb());      
$modulos = $GRID->g->get_dropdown_values("select distinct ModID as k, ModNombre as v from modulos");
$permisos = Permiso::toString();
$id = intval($_GET["rowid"]);

$GRID->campos(Archivos::grid(array("editar"=>$editar,"rol"=>$roles, "modulos"=>$modulos, "permisos"=>$permisos)));
$GRID->encabezado("Archivos", "ArcID", array(true, true, false, true, false), "asc", "400","200");
$GRID->sql("Select * from archivos where ArcModulo = $id", "archivos");

$e["on_insert"] = array("add_archivo", null, true);
$GRID->g->set_events($e);

function add_archivo(&$data)
{
    $id = intval($_GET["rowid"]);
    $data["params"]["ArcModulo"] = $id;
}

$detalles = $GRID->mostrar(2);

?>
<div class='row gx-5'>
    <div class='col-md-4'>
	    <?php echo $master;?>
 	</div>
 	<div class='col-md-8'>
 	    <?php echo $detalles;?>
 	</div>     
</div>
