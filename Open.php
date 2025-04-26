<?php

require_once 'Test.php';

echo 'Start :)' . PHP_EOL;

try {
    (new Test())->testing(['teil' => 5, 'integer' => 5]);
    echo 'Worked fine' . PHP_EOL;
} catch (Throwable $e){
    echo 'Error' . PHP_EOL;
}

echo 'End :O' . PHP_EOL;
