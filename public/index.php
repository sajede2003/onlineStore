<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\Application;
// use App\Core\Error;

// error_reporting(E_ALL);
// set_error_handler('app\Core\Error::errorHandler');
// set_exception_handler('app\Core\Error::exceptionHandler');

$app = new Application(dirname(__DIR__));

include_once './../routes/index.php';

$app->run();
