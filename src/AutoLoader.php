<?php
namespace Core;

require_once __DIR__ . "/../config/Namespaces.php";

class AutoLoader
{
    private $namespaces;

    public function __construct()
    {
        $this->namespaces = \Config\NameSpaces::$namespaces;
    }

    public function register()
    {
        spl_autoload_register(function ($class) 
        {
            $root = __DIR__ . "/../";
            $classExploded = explode("\\", $class);
            $className = end($classExploded);
            array_pop($classExploded);
            $namespace = implode("\\",$classExploded);
            $folder = $this->namespaces[$namespace];
            $fullPath = $root . $folder . $className . '.php';
            
            if (file_exists($fullPath)) {
                require $fullPath;
            }
        });
    }
}
