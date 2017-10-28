<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';


/**
 * front controller
 */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts = explode('/', $path);

$ctrl = !empty($pathParts[1]) ? ucfirst($pathParts[1]) : 'Form';
$act = !empty($pathParts[2]) ? ucfirst($pathParts[2]) : 'Index';

$controllerClassName = $ctrl . 'Controller';
$package_name = 'Controllers';
$fully_qualified_name = 'Parser' . '\\' .$package_name . '\\' . $controllerClassName;

$controller = new $fully_qualified_name();
$method = 'action' . $act;
echo $controller->$method();