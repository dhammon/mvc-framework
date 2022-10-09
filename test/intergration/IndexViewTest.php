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

    public function testConstruct()
    {
        $renderer = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "renderer");
        $entity = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "entity");

        $this->assertInstanceOf("\Core\Renderer", $renderer);
        $this->assertInstanceOf("\Core\Entity", $entity);
    }

    public function testRenderView()
    {
        $renderer = new \Core\Renderer();
        $entity = new \App\Entity\Base();
        $entity->setView("doesNotExist");
        $testObj = new \App\View\Index($renderer, $entity);
        
        ob_start();
        $testObj->render();
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }

    public function testRenderDefault()
    {
        ob_start();
        $this->testObj->render();
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }

    public function default()
    {
        ob_start();
        $this->reflector->invokePrivateMethod($this->testObj, "default", array());
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }

    public function index()
    {
        ob_start();
        $this->reflector->invokePrivateMethod($this->testObj, "index", array());
        $result = ob_get_clean();

        $this->assertEquals("1", preg_match("/hello world/", $result));
    }
}