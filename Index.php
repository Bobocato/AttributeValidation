<?php

echo 'Start :)' . PHP_EOL;

try {
    (new Test())->testing(['stringVariable' => 5, 'integerVariable' => 500, 'noValidation' => 'test']);
    echo 'Worked fine' . PHP_EOL;
} catch (Throwable $e){
    echo 'Error' . PHP_EOL;
}

echo 'End :O' . PHP_EOL;
