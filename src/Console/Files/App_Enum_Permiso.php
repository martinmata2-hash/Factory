<?php

namespace App\Enum;

enum Permiso: string
{
    case Ver = "View";
    case Agregar = "Add";
    case Editar = "Edit";
    case Eliminar = "Delete";        

     public static function getArray()
    {        
        return array_column(Permiso::cases(),"name","value");
    }

     public static function toString()
    {
        $array = Permiso::getArray();
        $request = "";
        foreach ($array as $key=>$item) 
        {
            $request .="$key:$item;";
        }
        $request = trim($request,";");
        return $request;
    }
    public static function matches(string $policy): bool
    {
        return self::$value === $policy;
    }
}
