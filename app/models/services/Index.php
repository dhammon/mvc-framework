<?php
namespace App\Service;


class Index implements \Core\Service
{
    private $host;
    private $user;
    private $pass;
    private $charSet;
    private $database;

    public function __construct()
    {
        $this->host = \Config\Database::$host;
        $this->user = \Config\Database::$user;
        $this->pass = \Config\Database::$pass;
        $this->charSet = \Config\Database::$charSet;
        $this->database = \Config\Database::$database;
    }
    
    public function index()
    {
        $dbHelper = new \Core\DBHelper();
        //$dbHelper->connect($this->host, $this->user, $this->pass, $this->database, $this->charSet);
        $mapper = new \App\Mapper\Index($dbHelper);

        //throw new \App\Exceptions\Index("/services/Index.php threw this");

        //other business logic classes instantiate here, use mapper results
        
        $entity = new \App\Entity\Index();
        $entity->setView('index');

        return $entity;
    }
}