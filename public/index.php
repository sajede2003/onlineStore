<?php

require_once __DIR__ . '\..\vendor\autoload.php';

session_start();

use App\Core\Application;

// error_reporting(E_ALL);
// set_error_handler(Error::errorHandler());
// set_exception_handler(Error::exceptionHandler());

$app = new Application(dirname(__DIR__));

include_once './../routes/index.php';

$app->run();
