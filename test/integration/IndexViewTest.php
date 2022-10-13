<?php
namespace Test\Integration;


require_once __DIR__ . "/../../src/AutoLoader.php";

class IndexViewTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $renderer = new \Core\Renderer();
        $entity = new \App\Entity\Base();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\View\Index";
        $this->testObj = new \App\View\Index($renderer, $entity);
    }

    public function testDefault()
    {
        ob_start();
        $this->reflector->invokePrivateMethod($this->testObj, "default", array());
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }

    public function testIndex()
    {
        ob_start();
        $this->reflector->invokePrivateMethod($this->testObj, "index", array());
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }
}