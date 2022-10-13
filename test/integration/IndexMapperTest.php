<?php
namespace Test\Integration;

use Core\DBHelper;

require_once __DIR__ . "/../../src/AutoLoader.php";

class IndexMapperTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $dbHelper = new DBHelper();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\Mapper\Index";
        $this->testObj = new \App\Mapper\Index($dbHelper);
    }

    public function testConstruct()
    {
        $dbHelper = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "dbHelper");

        $this->assertInstanceOf("\Core\DBHelper", $dbHelper);
    }

    public function testImplementation()
    {
        $this->assertInstanceOf("\Core\Mapper", $this->testObj);
    }
}