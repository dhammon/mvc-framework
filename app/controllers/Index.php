<?php
namespace App\Controller;

class Index implements \Core\Controller
{
    //public function index() is default
    
    public function default()
    {
        $service = new \App\Service\Index();
        $entity = $service->index();
        
        $renderer = new \Core\Renderer();
        $view = new \App\View\Index($renderer, $entity);
        $view->render();
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