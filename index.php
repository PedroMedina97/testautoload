<?php

use Classes\Router;
require 'vendor/autoload.php';

$router = new Router();


/*  echo '<pre>';
print_r($router->getUri());
echo '</pre>';  */

$controlador = $router->getController();
$method = $router->getMethod();
$param = $router->getParam();


if (file_exists('controllers/'.$controlador.'.php')){
    require 'controllers/'.$controlador.'.php';
}else{
    require 'controllers/not_found.php';
}


//echo "Controlador: $controlador </br>";
//echo "Metodo: $method </br>";
//echo "Parametro: $param </br>";