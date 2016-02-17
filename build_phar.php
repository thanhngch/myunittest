<?php
$src = '.';

$phar = new Phar($src . "/myphpunit.phar", 0, "myphpunit.phar");

// start buffering. Mandatory to modify stub.
$phar->startBuffering();

// Adding files
$phar->buildFromDirectory(__DIR__ . '/phpunit/', '/\.php$/');


// Get the default stub. You can create your own if you have specific needs
$defaultStub = file_get_contents(__DIR__ . '/phpunit/phpunit');

$array_stub = explode('<?php', $defaultStub);

// replace require in phar
$array_stub[1] = str_replace('require_once "autoload.php";', 
    'require_once "phar://myphpunit.phar/autoload.php";',
    $array_stub[1]);

// we change directory so we replace directory
$array_stub[1] = str_replace("__DIR__ . '/..", "__DIR__ . '", $array_stub[1]);

// set stub
$stub = $array_stub[0] . '<?php Phar::mapPhar("myphpunit.phar"); ' . $array_stub[1]
    . ' __HALT_COMPILER();';

// compress file in phar, uncomment code if you want commpress file
// $phar->compressFiles(Phar::GZ);

// Add the stub
$phar->setStub($stub);

$phar->stopBuffering();