<?php
/**
 * Class PHPTestResutl
 *
 * This class has one method more method will update late
 * @author nguyen-thanh (nguyen.thanh@mulodo.com)
 */
class PHPUnit
{
    /**
     * Test 2 value is equal
     * $v1 and $v2 is equal is $v1 == $v2 in PHP comparison
     * this is simple compare, it can update late
     * @param $v1 can be number, string, array, object
     * @param $v2 can be number, string, array, object
     * @return null
     */
    public function assertEquals($v1, $v2)
    {
        try {
            if ($v1 == $v2) {
                PHPTestResult::addTestPass();
            } else {
                throw new Exception("$v1 and $v2 is not equals.");
            }
        } catch (Exception $e) {
            $trace_message = explode("\n", $e->getTraceAsString());
            $first_message = $trace_message[0];
            $error_message = $e->getMessage() . "\n"
                . $first_message;

            PHPTestResult::addTestError($error_message);
        }
    }
}
