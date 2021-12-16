<?php 

use App\Controllers\CartController;
use App\Controllers\MorePageController;
use App\Controllers\SiteController;



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
$app->router->post('/add-bookmark' , [MorePageController::class , 'addBookMark']);
