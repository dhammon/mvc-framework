<?php
namespace Test\Integration;

require_once __DIR__ . "/../../src/AutoLoader.php";

class IndexControllerTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\Controller\Index";
        $this->testObj = new \App\Controller\Index();
    }

    public function testImplementation()
    {
        $this->assertInstanceOf("\Core\Controller", $this->testObj);
    }

    public function testConstruct()
    {
        $result = $this->reflector->getPrivateProperty($this->testObj, $this->classToTest, "service");
        $this->assertInstanceOf("\App\Service\Index", $result);
    }

    public function testRender()
    {
        $entity = new \App\Entity\Index();
        $entity->setView('default');

        ob_start();
        $this->testObj->render($entity);        
        $result = ob_get_clean();

        $this->assertEquals('1', preg_match('/hello world/', $result));
    }

    public function testDefault()
    {
        ob_start();
        $this->testObj->default();
        $result = ob_get_clean();
        
        $this->assertEquals('1', preg_match('/hello world/', $result));
    }

    public function testSomeAction()
    {
        $param = array(1);
        ob_start();
        $this->testObj->someAction($param);
        $result = ob_get_clean();

        $this->assertEquals('1', preg_match('/hit method/', $result));
        $this->assertEquals('1', preg_match('/\[0\] \=\> 1/', $result));
    }
}