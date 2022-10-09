<?php
namespace Test\Unit;

require_once __DIR__ . "/../../src/AutoLoader.php";

class BaseEntityTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\Entity\Base";
        $this->testObj = new \App\Entity\Base();
    }

    public function testSetView()
    {
        $someView = "someView";
        $this->testObj->setView($someView);
        $view = $this->testObj->getView();
        $this->assertEquals($someView, $view);
    }

    public function testSetErrorMessageAndDisplayErrorOn()
    {
        $_SESSION['errorMessage'] = "testErrorMessage";
        $expectedErrorMessage = "testErrorMessage";
        $expectedErrorDisplay = "error_on";

        $this->testObj->setErrorMessageAndDisplay();
        $actualErrorMessage = $this->testObj->getErrorMessage();
        $actualErrorDisplay = $this->testObj->getErrorDisplay();

        $this->assertEquals($expectedErrorMessage, $actualErrorMessage);
        $this->assertEquals($expectedErrorDisplay, $actualErrorDisplay);
    }

    public function testSetErrorMessageAndDisplayErrorOff()
    {
        $_SESSION['errorMessage'] = null;
        $expectedErrorMessage = null;
        $expectedErrorDisplay = "error_off";

        $this->testObj->setErrorMessageAndDisplay();
        $actualErrorMessage = $this->testObj->getErrorMessage();
        $actualErrorDisplay = $this->testObj->getErrorDisplay();

        $this->assertEquals($expectedErrorMessage, $actualErrorMessage);
        $this->assertEquals($expectedErrorDisplay, $actualErrorDisplay);
    }
    
    public function testGetView()
    {
        $someView = "someView";
        $this->testObj->setView($someView);
        $view = $this->testObj->getView();
        $this->assertEquals($someView, $view);
    }

    public function testGetErrorMessage()
    {
        $expectedErrorMessage = "testErrorMessage";
        $this->reflector->setPrivateProperty($this->testObj, $this->classToTest, "errorMessage", $expectedErrorMessage);
        $actualErrorMessage = $this->testObj->getErrorMessage();

        $this->assertEquals($expectedErrorMessage, $actualErrorMessage);
    }

    public function testGetErrorDisplay()
    {
        $expectedErrorDisplay = "error_on";
        $this->reflector->setPrivateProperty($this->testObj, $this->classToTest, "errorDisplay", $expectedErrorDisplay);
        $actualErrorDisplay = $this->testObj->getErrorDisplay();

        $this->assertEquals($expectedErrorDisplay, $actualErrorDisplay);
    }
}