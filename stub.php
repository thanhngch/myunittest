<?php
Phar::mapPhar("myphpunit.phar"); 
foreach (array(
    __DIR__ . '/../../autoload.php', 
    __DIR__ . '/../autoload.php', 
    __DIR__ . '/../vendor/autoload.php', 
    __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('PHPUNIT_COMPOSER_INSTALL', $file);
        break;
    }
}
require_once PHPUNIT_COMPOSER_INSTALL;
require_once "phar://myphpunit.phar/autoload.php";

require_once __DIR__ . "/test/CalculatorTest.php";

echo "PHPUnit by nguyen-thanh-mulodo\n\n";

$start_time = microtime(TRUE);

$test = new CalculatorTest;
$test->setUp();
$test->testAddNumber();

PHPTestResult::printResult();

$end_time = microtime(TRUE);

echo "\nTime: " . intval(($end_time - $start_time) * 1000000) / 1000 . " ms, ";
echo "Memory: " . round(memory_get_usage(TRUE)/1024, 0) . " KB\n";

__HALT_COMPILER();