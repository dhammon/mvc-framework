<?php
namespace App\Controller;

class Index implements \Core\Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new \App\Service\Index();
    }

    public function render(\Core\Entity $entity)
    {
        $renderer = new \Core\Renderer();
        $view = new \App\View\Index($renderer, $entity);
        $view->render();
    }

    public function default()
    {
        $entity = $this->service->index();
        $this->render($entity);
    }

    //example stub action with params
    public function someAction($param)
    {
        //should use service, entity, and view
        //this is just a sample
        print_r($param);
        print("hit method");
    }
}