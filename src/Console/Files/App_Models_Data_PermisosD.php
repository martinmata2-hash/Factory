<?php
namespace App\Models\Data;
use Marve\Ela\MySql\Interfaces\DataInterface;
use stdClass;


class PermisosD extends stdClass implements DataInterface
{
/**
* @var int
*
*/public $PusID;
/**
* @var int
*
*/public $PusUsuario;
/**
* @var string
*
*/
public $PusPermisos;
/**
* @var string
*
*/
public $PusPolicies;
/**
* @var int
*
*/public $deleted;

    public function __construct($datos = null)
    {
        try
        {
            if ($datos == null)
            {
                $this->PusID = 0;
$this->PusUsuario = 0;
$this->PusPermisos = "";
$this->PusPolicies = "";
$this->deleted = 0;

            }
            else
            {
                foreach ($datos as $k => $v)
                {
                    $this->$k = $v;
                }
            }
        }
        catch (\Exception $e)
        {}
    }
    public function sql()
    {
        return "CREATE TABLE `permisos` (
  `PusID` int(11) NOT NULL AUTO_INCREMENT,
  `PusUsuario` int(11) NOT NULL,
  `PusPermisos` varchar(100) NOT NULL,
  `PusPolicies` tinytext DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`PusID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci";
    }
}
