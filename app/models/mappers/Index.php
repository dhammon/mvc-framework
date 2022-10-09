<?php
namespace App\Mapper;


class Index implements \Core\Mapper
{
    private $dbHelper;

    public function __construct(\Core\DBHelper $dbHelper)
    {
        $this->dbHelper = $dbHelper;
    }
}