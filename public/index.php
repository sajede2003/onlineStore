<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\AdminController;
use App\Controllers\SiteController;
use App\Core\Application;
use App\Controllers\UsersController;
use App\Models\RegisterModel;

error_reporting(E_ALL);
set_error_handler('App\Core\Error::errorHandler');
set_exception_handler('App\Core\Error::exceptionHandler');


    
    $app = new Application(dirname(__DIR__));

    $app->router->get('/' , [SiteController::class , 'home']);
   require_once('../app/Routes/Home/Home.php');

    // go in login page
    $app->router->get('/login' , [UsersController::class , 'loginGet']);

    // after click submit
    $app->router->post('/login' , [UsersController::class , 'loginPost']);

    // go in register page
    $app->router->get('/register' , [UsersController::class , 'registerGet' ]);
    
    // click submit 
    $app->router->post('/register' , [RegisterModel::class , 'registerPost' ]);

    // go in table page

    $app->router->get('/table' , [SiteController::class , 'table']);


    $app->router->get( '/dashboard' , [AdminController::class , 'dashboard']);
    $app -> router ->get( '/dashboard/users' , [AdminController::class , 'users']);
    $app ->router ->get('/dashboard/category' , [AdminController::class , 'category']);
    $app -> router ->get('/dashboard/product' , [AdminController::class , 'product']);

    $app->run();


    