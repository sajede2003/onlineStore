<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Controllers\AdminController;
use App\Controllers\CartController;
use App\Controllers\SiteController;
use App\Controllers\UsersController;
use App\Controllers\MorePageController;
use App\Core\Application;

error_reporting(E_ALL);
set_error_handler('App\Core\Error::errorHandler');
set_exception_handler('App\Core\Error::exceptionHandler');

$app = new Application(dirname(__DIR__));

$app->router->get('/', [SiteController::class, 'home']);
require_once '../app/Routes/Home/Home.php';

// go in login page
$app->router->get('/login', [UsersController::class, 'loginGet']);

// after click submit
$app->router->post('/login', [UsersController::class, 'loginPost']);

// go in register page
$app->router->get('/register', [UsersController::class, 'registerGet']);

// register submit
$app->router->post('/register', [UsersController::class, 'registerPost']);


// cart button
$app->router->get('/cart', [SiteController::class, 'cart']);

// go in table page
$app->router->get('/table', [SiteController::class, 'table']);

// product
$app->router->get('/product' , [SiteController::class , 'product']);


// cart
$app->router->get('/cart' , [CartController::class , 'cart']);
$app->router->get('/add-to-cart' , [CartController::class , 'addToCart']);
$app->router->get('/remove-to-cart' , [CartController::class , 'removeFromCart']);

// more page
$app->router->get('/more' , [MorePageController::class , 'more']);
$app->router->get('/like' , [MorePageController::class , 'addLike']);
$app->router->post('/score' , [MorePageController::class , 'addScore']);
$app->router->post('/comment' , [MorePageController::class , 'addComment']);


// dashboard
$app->router->get('/dashboard', [AdminController::class, 'dashboard']);

// Users section
$app->router->get('/dashboard/users', [AdminController::class, 'users']);
$app->router->get('/dashboard/users/edit' , [AdminController::class , 'userEdit']);
$app->router->post('/dashboard/users/edit' , [AdminController::class , 'usersEditPost']);
$app->router->get('/dashboard/users/delete' , [AdminController::class , 'userDelete']);

// category section
$app->router->get('/dashboard/category', [AdminController::class, 'Category']);
$app->router->get('/dashboard/category/add' , [AdminController::class , 'addCategory']);
$app->router->post('/dashboard/category/add' , [AdminController::class , 'addCategoryPost']);
$app->router->get('/dashboard/category/edit' , [AdminController::class , 'categoryEdit']);
$app->router->post('/dashboard/category/edit' , [AdminController::class , 'categoryEditPost']);
$app->router->get('/dashboard/category/delete' , [AdminController::class , 'categoryDelete']);

// product section
$app->router->get('/dashboard/product', [AdminController::class, 'product']);
$app->router->get('/dashboard/product/add' , [AdminController::class , 'addProduct']);
$app->router->post('/dashboard/product/add' , [AdminController::class , 'addProductPost']);
$app->router->get('/dashboard/product/edit' , [AdminController::class , 'productEdit']);
$app->router->post('/dashboard/product/edit' , [AdminController::class , 'productEditPost']);
$app->router->get('/dashboard/product/delete' , [AdminController::class , 'productDelete']);

$app->run();
