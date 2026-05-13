<?php
namespace App\Models\Data;
use Marve\Ela\MySql\Interfaces\DataInterface;
use stdClass;


class ArchivosD extends stdClass implements DataInterface
{
/**
* @var int
*
*/public $ArcID;
/**
* @var string
*
*/
public $ArcNombre;
/**
* @var string
*
*/
public $ArcPath;
/**
* @var string
*
*/
public $ArcIcon;
/**
* @var int
*
*/public $ArcModulo;
/**
* @var int
*
*/public $ArcOrden;
/**
* @var int
*
*/public $ArcSubModulo;
/**
* @var string
*
*/
public $ArcPermisos;
/**
* @var int
*
*/public $updated;

    public function __construct($datos = null)
    {
        try
        {
            if ($datos == null)
            {
                $this->ArcID = 0;
$this->ArcNombre = "";
$this->ArcPath = "";
$this->ArcIcon = "";
$this->ArcModulo = 0;
$this->ArcOrden = 0;
$this->ArcSubModulo = 0;
$this->ArcPermisos = "";
$this->updated = 0;

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
        return "CREATE TABLE `archivos` (
  `ArcID` int(11) NOT NULL AUTO_INCREMENT,
  `ArcNombre` varchar(50) NOT NULL,
  `ArcPath` varchar(50) NOT NULL,
  `ArcIcon` varchar(50) NOT NULL,
  `ArcModulo` int(11) NOT NULL,
  `ArcOrden` int(11) NOT NULL,
  `ArcSubModulo` int(11) NOT NULL,
  `ArcPermisos` varchar(50) DEFAULT NULL,
  `updated` int(1) NOT NULL,
  PRIMARY KEY (`ArcID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
INSERT INTO `archivos` (`ArcID`, `ArcNombre`, `ArcPath`, `ArcIcon`, `ArcModulo`, `ArcOrden`, `ArcSubModulo`, `ArcPermisos`, `updated`) VALUES
(1, 'Archivos', 'Archivos', '', 1, 1, 0, 'Delete', 0);";
    }
}
