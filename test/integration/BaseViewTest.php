<?php
namespace Test\Integration;


require_once __DIR__ . "/../../src/AutoLoader.php";

class BaseViewTest extends \PHPUnit\Framework\TestCase
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
        $this->classToTest = "\App\View\Base";
        $this->testObj = new \App\View\Base($renderer, $entity);
    }

    public function testConstruct()
    {
        $renderer = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "renderer");
        $entity = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "entity");

        $this->assertInstanceOf("\Core\Renderer", $renderer);
        $this->assertInstanceOf("\Core\Entity", $entity);
    }

    public function testRenderViewException()
    {
        $this->expectException("exception");
        $renderer = new \Core\Renderer();
        $entity = new \App\Entity\Base();
        $entity->setView("doesNotExist");
        $testObj = new \App\View\Base($renderer, $entity);
        $testObj->render();
    }
}