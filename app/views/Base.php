<?php
namespace App\View;


class Base implements \Core\View
{
    protected $renderer;
    protected $entity;

    public function __construct(\Core\Renderer $renderer, \Core\Entity $entity)
    {
        $this->renderer = $renderer;
        $this->entity = $entity;
    }

    public function render()
    {
        $view = $this->entity->getView();
        $class = get_class($this);

        if(method_exists($this, $view) && is_callable("$class::$view"))
        {
            $this->$view();
        }
        else
        {
            throw new \Exception("View not found");
        }
    }
}