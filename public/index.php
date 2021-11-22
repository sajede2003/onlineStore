<?php

require_once __DIR__.'/../vendor/autoload.php';

use controllers\AuthController;
use controllers\SiteController;
use core\Application;

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

    // go in table page
    // $app->router->get('/table' , [SiteController::class , 'table']);

    $app->router->get('/table' , [SiteController::class , 'table']);


    $app->run();

