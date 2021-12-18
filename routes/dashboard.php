<?php 

use App\Controllers\AdminController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\UsersController;
use App\Controllers\Admin\CategoryController;

// dashboard
$app->router->get('/dashboard', [AdminController::class, 'dashboard']);

// Users section
$app->router->get('/dashboard/users', [UsersController::class, 'users']);
$app->router->get('/dashboard/users/edit' , [UsersController::class , 'userEdit']);
$app->router->post('/dashboard/users/edit' , [UsersController::class , 'usersEditPost']);
$app->router->get('/dashboard/users/delete' , [UsersController::class , 'userDelete']);

// category section
$app->router->get('/dashboard/category', [CategoryController::class, 'Category']);
$app->router->get('/dashboard/category/add' , [CategoryController::class , 'addCategory']);
$app->router->post('/dashboard/category/add' , [CategoryController::class , 'addCategoryPost']);
$app->router->get('/dashboard/category/edit' , [CategoryController::class , 'categoryEdit']);
$app->router->post('/dashboard/category/edit' , [CategoryController::class , 'categoryEditPost']);
$app->router->get('/dashboard/category/delete' , [CategoryController::class , 'categoryDelete']);

// product section
$app->router->get('/dashboard/product', [ProductController::class, 'product']);
$app->router->get('/dashboard/product/add' , [ProductController::class , 'addProduct']);
$app->router->post('/dashboard/product/add' , [ProductController::class , 'addProductPost']);
$app->router->get('/dashboard/product/edit' , [ProductController::class , 'productEdit']);
$app->router->post('/dashboard/product/edit' , [ProductController::class , 'productEditPost']);
$app->router->get('/dashboard/product/delete' , [ProductController::class , 'productDelete']);