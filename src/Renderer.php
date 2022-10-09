<?php
namespace Core;

class Renderer
{
    protected $vars = array();

    public function render($viewFile)
    {
        include $viewFile;
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function __get($name)
    {
        return $this->vars[$name];
    }
}