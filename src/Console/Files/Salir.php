<?php

use App\Core\Acceso;
use App\Core\Login;
use Marve\Ela\Core\Session;

/**
 *
 * @version 2022_1
 * @author Martin Mata
 */
@session_start();
include_once 'vendor/autoload.php';
$LOGIN = new Login();
$SESSION = new Session();
if($SESSION->getID())
    $LOGIN->sesionDestroy($SESSION->getId());

if (isset($_SERVER['HTTP_COOKIE'])) 
{
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) 
    {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}

header("Location: /Dashboard/Login");
exit();
