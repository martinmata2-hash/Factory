<?php
namespace App\Core;

use App\Models\Data\PagesD;
use App\Models\Data\PoliciesD;
use Marve\Ela\Core\CurrentUser;
use Marve\Ela\Core\DotEnv;
use Marve\Ela\Core\Model;
use Marve\Ela\MySql\Interfaces\DatabaseInterface;

class Policies extends Model implements DatabaseInterface
{
   

    /**
     *
     * @var PagesD
     */
    public $data;
    
    public function __construct( $data_base = "")
    {
        if($data_base == "")
            $data_base = DotEnv::getDB();
        $this->data_base = $data_base;
        $this->mensaje = array();        
        parent::__construct($data_base, "policies");
        
        //Inicar tabla
        $this->createTable(new PoliciesD());
        $this->updateTable();
    }

    public function remove(string $id, string $campo="ArcID",  int $usuario = 0)
    {
        if(CurrentUser::isAdmin())
           return  parent::remove($id,$campo,$usuario);
        else return 0;
    }           
        
}
