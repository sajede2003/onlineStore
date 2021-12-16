<?php namespace App\Controllers;


use App\Core\Controller;
use App\Models\Product;

class SiteController extends Controller
{
    protected Product $products;

    public function __construct() {
        $this->products = new Product;
    }

    public function home()
    {
        (isset($_SESSION['user_fullName']))?$_SESSION['user_fullName']:$_SESSION['user_fullName']=null;
        $params = [
            'name' => $_SESSION['user_fullName'],
        ];
        return $this->render('home', $params);
    }

    public function product()
    {
        $allProducts = $this->products->get();
        
        $params = [
            'products' => $allProducts
        ];

        return $this->render('product/list' , $params);
    }
    
}