<?php
namespace App\View;


class Index extends Base
{
    protected function default()
    {
        $this->index();
    }

    protected function index()
    {
        $this->renderer->message = "hello world";
        //TODO think of cleaner way of getting body.php
        $this->renderer->render(__DIR__ . "/templates/body.php");
    }
}