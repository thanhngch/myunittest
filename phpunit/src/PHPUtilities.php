<?php
/**
 * This file list utitlies function for phpunit file
 * @author nguyen-thanh-mulodo
 */

/**
 * This method will invoke an all method test (class name begin with test) in class
 * @param $reflection_class
 * @param $object
 * @return null
 */
function invoke_method(ReflectionClass & $reflection_class, & $object)
{
    // get class name
    $class_name = $reflection_class->getName();

    // get list method
    $list_method = $reflection_class->getMethods();

    // loop list method
    foreach ($list_method as $method) {

        // get method name begin with test
        if (preg_match('/^test.*/', $method->getName())) {

            // get document comment of this method
            $doc_comment = $method->getDocComment();

            // if method don't have document comment, we invoke it
            if ($doc_comment === FALSE) {
                $method->invoke($object);
            } else {

                // find document comment @dataProvider
                preg_match('/@dataProvider (\w+)/', $doc_comment, $match_data_provider);
                
                $array_list_parameter = array();

                if (count($match_data_provider) == 2) {

                    // get method provider
                    $method_data_provider = $match_data_provider[1];

                    if ($reflection_class->hasMethod($method_data_provider)) {

                        // get array of list paramenter
                        $array_list_parameter = $object->$method_data_provider();   
                    } else {

                        // thow and error or show warning in this situation 
                        throw new BadMethodCallException("\e[41mData provider is invalid in method: " . 
                            $class_name . ":" . $method->getName() . "\e[0m");
                    }

                } else {
                    $method->invoke($object);
                }

                if(!empty($array_list_parameter)) {

                    // loop in $array_list_parameter and invoke method which parameter
                    foreach ($array_list_parameter as $paramenter) {
                        $method->invokeArgs($object, $paramenter);
                    }
                }
                
            }

        }
    }
}