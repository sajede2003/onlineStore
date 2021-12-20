<?php 

use App\Controllers\AdminController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\UsersController;
use App\Controllers\Admin\CategoryController;

// dashboard
$app->router->get('/dashboard', [AdminController::class, 'dashboard']);

// Users section
$app->router->get('/dashboard/users', [UsersController::class, 'index']);
$app->router->get('/dashboard/users/edit' , [UsersController::class , 'edit']);
$app->router->post('/dashboard/users/edit' , [UsersController::class , 'update']);
$app->router->get('/dashboard/users/delete' , [UsersController::class , 'delete']);

// category section
$app->router->get('/dashboard/category', [CategoryController::class, 'index']);
$app->router->get('/dashboard/category/add' , [CategoryController::class , 'add']);
$app->router->post('/dashboard/category/add' , [CategoryController::class , 'store']);
$app->router->get('/dashboard/category/edit' , [CategoryController::class , 'edit']);
$app->router->post('/dashboard/category/edit' , [CategoryController::class , 'update']);
$app->router->get('/dashboard/category/delete' , [CategoryController::class , 'delete']);

// product section
$app->router->get('/dashboard/product', [ProductController::class, 'index']);
$app->router->get('/dashboard/product/add' , [ProductController::class , 'add']);
$app->router->post('/dashboard/product/add' , [ProductController::class , 'store']);
$app->router->get('/dashboard/product/edit' , [ProductController::class , 'edit']);
$app->router->post('/dashboard/product/edit' , [ProductController::class , 'update']);
$app->router->get('/dashboard/product/delete' , [ProductController::class , 'delete']);