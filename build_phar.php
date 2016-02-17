<?php
$src = '.';

$phar = new Phar($src . "/myphpunit.phar", 0, "myphpunit.phar");

// start buffering. Mandatory to modify stub.
$phar->startBuffering();

// Adding files
$phar->buildFromDirectory(__DIR__ . '/phpunit/', '/\.php$/');


// Get the default stub. You can create your own if you have specific needs
 // $defaultStub = $phar->createDefaultStub('phpunit.php');
$defaultStub = file_get_contents(__DIR__ . '/stub.php');

// compress file in phar
// $phar->compressFiles(Phar::GZ);

// Create a custom stub to add the shebang
$stub = "#!/usr/bin/env php\n" . $defaultStub;

// Add the stub
$phar->setStub($stub);

$phar->stopBuffering();