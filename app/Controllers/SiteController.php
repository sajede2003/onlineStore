<?php namespace App\Controllers;


use App\Controllers\Controller;
use App\Models\Product;

class SiteController extends Controller
{
    protected Product $products;

    public function __construct() {
        $this->products = new Product;
    }
    //render home page view
    public function home()
    {
        $user_name = session()->get('user_name');
        $message = session()->get('flash.message');
        session()->delete('flash.message');
        return $this->render('home', compact('user_name','message'));
    }
    // render product page view
    public function product()
    {
        $products = $this->products->get();


        return $this->render('product/list' , compact('products'));
    }
    
}