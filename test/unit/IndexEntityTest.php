<?php
namespace Test\Unit;

require_once __DIR__ . "/../../src/AutoLoader.php";

class IndexEntityTest extends \PHPUnit\Framework\TestCase
{
    private $testObj;
    private $reflector;
    private $classToTest;

    public function setUp(): void
    {
        $loader = new \Core\AutoLoader();
        $loader->register();

        $this->reflector = new \Core\Reflector();
        $this->classToTest = "\App\Entity\Index";
        $this->testObj = new \App\Entity\Index();
    }

    public function testImplementation()
    {
        $this->assertInstanceOf("\Core\Entity", $this->testObj);
    }
}