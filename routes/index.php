<?php 


use App\Controllers\SiteController;


$app->router->get('/', [SiteController::class, 'home']);
include_once './../routes/index.php';


include_once 'auth.php';
include_once 'dashboard.php';
include_once 'product.php';