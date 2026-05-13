<?php
namespace App\Models\Data;
use Marve\Ela\MySql\Interfaces\DataInterface;
use stdClass;


class PoliciesD extends stdClass implements DataInterface
{
/**
* @var int
*
*/public $PolID;
/**
* @var int
*
*/public $PolUsuario;
/**
* @var string
*
*/
public $PolFile;
/**
* @var string
*
*/
public $PolPolicy;
/**
* @var string
*
*/
public $lastupdate;
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
                $this->PolID = 0;
$this->PolUsuario = 0;
$this->PolFile = "";
$this->PolPolicy = "";
$this->lastupdate = "";
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
        return "CREATE TABLE `policies` (
  `PolID` int(11) NOT NULL AUTO_INCREMENT,
  `PolUsuario` int(11) NOT NULL,
  `PolFile` varchar(255) NOT NULL,
  `PolPolicy` varchar(100) NOT NULL,
  `lastupdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated` int(1) NOT NULL,
  PRIMARY KEY (`PolID`),
  UNIQUE KEY `poliza_unica` (`PolUsuario`,`PolFile`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci";
    }
}
