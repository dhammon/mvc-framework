<?php
namespace Test\Integration;


require_once __DIR__ . "/../../src/AutoLoader.php";

class IndexServiceTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\Service\Index";
        $this->testObj = new \App\Service\Index();
    }

    public function testConstruct()
    {
        $user = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "user");
        $pass = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "pass");
        $host = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "host");
        $charSet = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "charSet");
        $database = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "database");
        
        $this->assertEquals(\Config\Database::$host, $host);
        $this->assertEquals(\Config\Database::$user, $user);
        $this->assertEquals(\Config\Database::$pass, $pass);
        $this->assertEquals(\Config\Database::$charSet, $charSet);
        $this->assertEquals(\Config\Database::$database, $database);
    }

    public function testIndex()
    {
        $entity = $this->testObj->index();

        $this->assertInstanceOf("\Core\Entity", $entity);
        $this->assertEquals("index", $entity->getView());
    }
}