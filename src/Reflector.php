<?php
namespace Core;

class Reflector
{
    public function invokePrivateMethod($object, $methodName, array $parameters = array())
    {
        $reflectedObject = new \ReflectionClass(get_class($object));
        $reflectedMethod = $reflectedObject->getMethod($methodName);
        $reflectedMethod->setAccessible(true);

        return $reflectedMethod->invokeArgs($object, $parameters);
    }

    public function getPrivateProperty($object, $className, $propertyName)
    {
        $reflectedObject = new \ReflectionClass($className);
        $reflectedProperty = $reflectedObject->getProperty($propertyName);
        $reflectedProperty->setAccessible(true);

        return $reflectedProperty->getValue($object);
    }

    public function setPrivateProperty($object, $className, $propertyName, $newValue)
    {
        $reflectedObject = new \ReflectionClass($className);
        $reflectedProperty = $reflectedObject->getProperty($propertyName);
        $reflectedProperty->setAccessible(true);

        $reflectedProperty->setValue($object, $newValue);
    }
}