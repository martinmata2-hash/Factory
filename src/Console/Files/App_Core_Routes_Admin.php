<?php

$APP->router->get("/Usuario",                       $inicio."App/Views/Admin/Usuario.php");//->middleware('auth',["page"=>"Clientes"]);
$APP->router->get("/Usuario/{CliID}",               $inicio."App/Views/Admin/Usuario.php");//->middleware('auth',["page"=>"Clientes"]);
$APP->router->get("/Usuarios",                      $inicio."App/Views/Admin/Usuarios.php");
$APP->router->post("/Usuarios",                     $inicio."App/Views/Admin/Usuarios.php");

$APP->router->get("/Permisos/{UsuID}",                      $inicio."App/Views/Admin/Permisos.php");