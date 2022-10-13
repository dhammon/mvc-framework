<?php
namespace Config;

class Routes
{
    static $routes = [
        // "{controller}/{method}" => ["HTTPMETHOD" => "controller@method"]
        "/"                    => ["GET"    => "Index@default"],
        "/index/someAction"    => ["GET"    => "Index@someAction"],
    ];
}
