<?php
namespace Config;

class Routes
{
    static $routes = [
        //http Method => ["{controller}/{method}" => "controller@method"]
        "GET" => ["/" => "Index@default"],
        "GET" => ["/index/someAction" => "Index@someAction"]
    ];
}
