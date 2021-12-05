<?php
use App\Controllers\ContactController;

$app->router->get('/contact' , [ContactController::class , 'contactGet']);

$app->router->post('/contact' , [ContactController::class , 'contactPost']);


