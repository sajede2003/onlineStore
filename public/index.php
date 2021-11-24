<?php

require_once __DIR__.'/../vendor/autoload.php';

use Controllers\AdminController;
use Controllers\AuthController;
use Controllers\SiteController;
use Core\Application;


    $app = new Application(dirname(__DIR__));

    $app->router->get('/' , [SiteController::class , 'home']);
   require_once('../Routes/Home/Home.php');

    // go in login page
    $app->router->get('/login' , [AuthController::class , 'login' ]);

    // after click submit
    $app->router->post('/login' , [AuthController::class , 'login' ]);

    // go in register page
    $app->router->get('/register' , [AuthController::class , 'registerGet' ]);
    
    // click submit 
    $app->router->post('/register' , [AuthController::class , 'registerPost' ]);

    // go in table page

    $app->router->get('/table' , [SiteController::class , 'table']);


    $app->router->get( '/dashboard' , [AdminController::class , 'dashboard']);
    $app -> router ->get( '/dashboard/users' , [AdminController::class , 'users']);
    $app ->router ->get('/dashboard/category' , [AdminController::class , 'category']);
    $app -> router ->get('/dashboard/product' , [AdminController::class , 'product']);

    $app->run();


    