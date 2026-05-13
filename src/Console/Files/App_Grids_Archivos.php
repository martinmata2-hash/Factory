<?php

namespace App\Grids;

class Archivos
{
    public static function grid($arguments = [])
    {
         return array(
            array(
                "title" => "ID",               
                "name" => "ArcID",                
                "editable" => false,                              
                "width" => "40",              
                "hidden" => true,                 
                "hidedlg" => true,            
                "export" => false),
            array(
                "title" => "updated",               
                "name" => "updated",                
                "editable" => true,
                "default" => "0",                            
                "width" => "10",              
                "hidden" => true,                 
                "hidedlg" => true,            
                "export" => false),
            array(
                "title" => "Nombre",
                "name" => "ArcNombre",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center",
                "link" => $arguments["link"],
                "linkoptions" => "class='box'"
            ),
            array(
                "title" => "Url",
                "name" => "ArcPath",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center"                
            ),
            array(
                "title" => "Icono",
                "name" => "ArcIcon",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center"                
            ),
            array(
                "title" => "Orden",
                "name" => "ArcOrden",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center"                
            ),
            array(
                "title" => "Modulo",
                "name" => "ArcModulo",
                "editable" => $arguments["editar"],
                "width" => "40",
                "align" => "center",
                "editoptions" => array("value" => $arguments["modulos"]),
                "edittype" => "select",
                "op" => "eq",
                "formatter" => "select",
                "searchoptions" => array("value" => "0:SELECCIONA;" . $arguments["modulos"]),
                "stype" => "select"
            ),
            array(
                "title" => "Permisos",
                "name" => "ArcPermisos",
                "editable" => $arguments["editar"],
                "width" => "40",
                "align" => "center",
                "editoptions" => array("value" => $arguments["permisos"]),
                "edittype" => "select",
                "op" => "eq",
                "formatter" => "select",
                "searchoptions" => array("value" => "0:SELECCIONA;" . $arguments["permisos"]),
                "stype" => "select"
            )            
        );
    }

    public static function modulos($arguments = [])
    {
         return array(
            array(
                "title" => "ID",               
                "name" => "ModID",                
                "editable" => false,                              
                "width" => "40",              
                "hidden" => true,                 
                "hidedlg" => true,            
                "export" => false),
            array(
                "title" => "updated",               
                "name" => "updated",                
                "editable" => true,
                "default" => "0",                            
                "width" => "10",              
                "hidden" => true,                 
                "hidedlg" => true,            
                "export" => false),
            array(
                "title" => "Nombre",
                "name" => "ModNombre",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center",
                "link" => $arguments["link"],
                "linkoptions" => "class='box'"
            ),
            array(  
                "title" => "Url",
                "name" => "ModPath",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center"                
            ),            
            array(
                "title" => "Orden",
                "name" => "ModOrden",
                "editable" => $arguments["editar"],
                "width" => "100",
                "align" => "center"                
            ),            
            array(
                "title" => "Rol",
                "name" => "ModRol",
                "editable" => $arguments["editar"],
                "width" => "40",
                "align" => "center",
                "editoptions" => array("value" => $arguments["rol"]),
                "edittype" => "select",
                "op" => "eq",
                "formatter" => "select",
                "searchoptions" => array("value" => "0:SELECCIONA;" . $arguments["rol"]),
                "stype" => "select"
            )            
        );
    }
}