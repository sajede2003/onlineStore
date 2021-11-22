<?php

require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

    $app = new Application(dirname(__DIR__));

    $app->router->get('/' , [SiteController::class , 'home']);

   require_once('../routes/home/home.php');

    // go in login page
    $app->router->get('/login' , [AuthController::class , 'login' ]);

    // after click submit
    $app->router->post('/login' , [AuthController::class , 'login' ]);

    // go in register page
    $app->router->get('/register' , [AuthController::class , 'register' ]);
    
    // click submit 
    $app->router->post('/register' , [AuthController::class , 'register' ]);
    $app->run();

