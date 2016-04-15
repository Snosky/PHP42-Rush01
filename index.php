<?php
session_start();

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('DS', DIRECTORY_SEPARATOR);
define('WEBROOT', str_replace('index.php', '', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']));

function __autoload($classname)
{
    $file = ROOT.DS.str_replace('\\', DS, $classname).'.class.php';
    if (file_exists($file))
        include $file;
}

$url = explode('/', $_GET['url']);
$controller = (!empty($url[0])) ? 'Controller\\'.ucfirst($url[0]).'Controller' : 'Controller\HomeController';
array_shift($url);
$method = (!empty($url[0])) ? lcfirst($url[0]).'Action' : 'homeAction';
array_shift($url);

$controller = new $controller;
if ($controller && method_exists($controller, $method))
{
    call_user_func_array(array($controller, $method), $url);
}
else
{
    header("HTTP/1.0 404 Not Found");
    die('404');
}