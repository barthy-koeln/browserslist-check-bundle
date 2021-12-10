<?php

$loader = @include __DIR__.'/../vendor/autoload.php';

if (!$loader) {
    die('You must set up the project dependencies, run the following commands: composer install');
}

require_once __DIR__.'/AppKernel.php';
