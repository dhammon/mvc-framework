<?php
session_start();
require_once __DIR__ . "/../src/AutoLoader.php";

try 
{
    $loader = new Core\AutoLoader();
    $loader->register();

    $routes = Config\Routes::$routes;
    $router = new Core\Router($routes);
    $router->dispatch();
}

catch (\App\Exceptions\Index $exception)
{
    echo $exception->getMessage();
}

catch (Exception | Error $exception)
{
    $rand = rand(10000,99999);
    $message = "Oops, something went exceptionally wrong $rand ";
    error_log($message . $exception->getMessage(), 0);

    echo $message;
}
