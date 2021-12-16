<?php 

use App\Controllers\AdminController;

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