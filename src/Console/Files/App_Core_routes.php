<?php

use Marve\Ela\Core\CurrentUser;

if($LOGED->isLoged())
{
    /************ Login  **/   
    $APP->router->get("/Salir",           $inicio."Salir.php");
    
    
    $APP->router->get("/Login",          $inicio."App/Views/Login.php");

    $APP->router->get("/Backup",          $inicio."App/Views/Respaldo.php");
    
    /************ Catalogos  **/
    //include_once($inicio."App/Core/Routes/Catalogos.php");
    
    /************ Listas  **/
    //include_once($inicio."App/Core/Routes/Listas.php");
    

    /*********** Inventarios **/
    //include_once($inicio."App/Core/Routes/Inventarios.php");


    /************ Listas  **/
    //include_once($inicio."App/Core/Routes/Listas.php");


     /************ POS  **/
     //include_once($inicio."App/Core/Routes/Pos.php");
    /***************************************************/

    
     /************ Caja  **/
     //include_once($inicio."App/Core/Routes/Caja.php");
    /***************************************************/

     /************ Taller  **/
     //include_once($inicio."App/Core/Routes/Taller.php");

    /***************************************************/
    /*************** Admin **/
    if(CurrentUser::isAdmin())
    {
          /*************** Admin **/
          include_once($inicio."App/Core/Routes/Admin.php");                
    }
    /***************** Supervisor */                
    if(CurrentUser::isSupervisor())
    {
         /************ Reportes  **/
     //include_once($inicio."App/Core/Routes/Reportes.php");
    }
     if(CurrentUser::isSuperAdmin())
    {
        $APP->router->get("/Archivos",       $inicio."App/Views/Admin/Archivos.php");
        $APP->router->post("/Archivos",       $inicio."App/Views/Admin/Archivos.php");        
    }
    
    $APP->router->get("/Salir",       $inicio."Salir.php");        
}
else /****** Acesible para los que no estan logeados */
{
    $APP->router->get("/Home",        $inicio."App/Views/Login.php");
    $APP->router->get("/",            $inicio."App/Views/Login.php");   
    $APP->router->get("/Login",       $inicio."App/Views/Login.php");
    $APP->router->get("/Salir",       $inicio."Salir.php");        
}