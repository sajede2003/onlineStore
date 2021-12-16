<?php 

use App\Controllers\UsersController;


// go in login page
$app->router->get('/login', [UsersController::class, 'loginGet']);

// after click submit
$app->router->post('/login', [UsersController::class, 'loginPost']);

// go in register page
$app->router->get('/register', [UsersController::class, 'registerGet']);

// register submit
$app->router->post('/register', [UsersController::class, 'registerPost']);

// log out submit
$app->router->get('/logout' , [UsersController::class , 'logOut']);
