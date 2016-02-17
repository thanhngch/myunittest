<?php
/**
 * Class PHPTestResutl
 *
 * This class is static variable to save some test result infomation
 * and can print it
 * @author nguyen-thanh (nguyen.thanh@mulodo.com)
 */
class PHPTestResult
{
    private static $number_test_pass = 0;
    private static $number_test_error = 0;
    private static $list_error_message;

    public static function printResult()
    {
        $number_test = self::$number_test_pass + self::$number_test_error;
        if (self::$number_test_error == 0) {
            echo "\e[7;32mOK (" . self::$number_test_pass . " tests)\e[0m\n";
        }
        if (self::$number_test_error != 0) {
            // var_dump(self::$list_error_message);
            $number_message_value = count(self::$list_error_message);
            echo "There was $number_message_value failure\n\n";
            foreach (self::$list_error_message as $message) {
                echo $message . "\n";
            }
            
            echo "\n\e[41mFAILURES!" . "\e[0m\n";
            echo "\e[41mTest " . $number_test . ', Assertions:' . self::$number_test_pass .
                ", Failures " . self::$number_test_error . "\e[0m\n";
        }
        
    }
    
    public static function addTestPass()
    {
        self::$number_test_pass++;
    }

    public static function addTestError($error_message)
    {
        self::$number_test_error++;
        self::$list_error_message[] = $error_message;
    }
}
