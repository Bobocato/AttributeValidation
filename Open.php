<?php

require_once 'Test.php';

echo 'Start :)' . PHP_EOL;

try {
    (new Test())->testing(['teil' => 5, 'integer' => 5]);
    echo 'Kein Fehler' . PHP_EOL;
} catch (Throwable $e){
    echo 'Fehler' . PHP_EOL;
}

echo 'End :O' . PHP_EOL;
