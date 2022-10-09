<?php
namespace App\View;


class Index implements \Core\View
{
    private $renderer;
    private $entity;

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
            call_user_func_array("$class::$view", array());
        }
        else
        {
            call_user_func_array("$class::default", array());
        }
    }

    private function default()
    {
        $this->index();
    }

    private function index()
    {
        $this->renderer->message = "hello world";
        //TODO think of cleaner way of getting body.php
        $this->renderer->render(__DIR__ . "/templates/body.php");
    }
}