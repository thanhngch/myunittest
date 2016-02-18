<?php
/**
 * This method will invoke an all method test (class name begin with test) in class
 * @param $reflection_class
 * @param $object
 * @return null
 */
function invoke_method(ReflectionClass & $reflection_class, & $object)
{
    $list_method = $reflection_class->getMethods();
    foreach ($list_method as $method) {
        if (preg_match('/^test.*/', $method->getName())) {
            $method->invoke($object);
        }
    }
}