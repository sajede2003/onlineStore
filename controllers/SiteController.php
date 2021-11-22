<?php namespace app\controllers;

use app\core\Application;
use app\core\controller;
use app\core\Request;

class SiteController extends controller {

    public function home(){
        $params=[
            'name'=>"TheCodeholic",
        ];
        return $this->render('home' , $params);
    }

    public function contact(){
        return $this->render('contact');
    }

    public function handleContact(Request $request){
        $body = $request->getBody();
        return 'handling submitted data';
    }

}